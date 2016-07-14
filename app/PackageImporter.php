<?php

namespace Padarom\Thunderstorm;

use Padarom\Thunderstorm\Models\UpdatableVersion;
use Padarom\Thunderstorm\Models\MentionedPackage;
use Padarom\Thunderstorm\Models\PackageVersion;
use Padarom\Thunderstorm\Models\LocalizedTag;
use Padarom\Thunderstorm\Models\Package;

class PackageImporter
{
    /**
     * @var DOMWrapper
     */
    protected $dom;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $versionNumber;

    /**
     * @var Package
     */
    protected $package;

    /**
     * @var PackageVersion
     */
    protected $version;

    public function __construct(DOMWrapper $package)
    {
        $this->dom = $package;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getVersionNumber()
    {
        return $this->versionNumber;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function run()
    {
        $this->identifier = $this->dom->getElementAttribute('package', 'name');
        $this->versionNumber = $this->dom->getElementValue('version');

        $this->package = $this->buildPackage();

        // Setup complete, now run the import
        $this->importAuthor()
             ->importNameAndDescription()
             ->importVersion()
             ->importUpdatableVersions()
             ->importRequiredPackages()
             ->importExcludedPackages();
    }

    /**
     * @return PackageImporter
     */
    protected function importAuthor()
    {
        $package = $this->package;

        $package->author    = $this->dom->getElementValue('author');
        $package->authorurl = $this->dom->getElementValue('authorurl');
        $package->save();

        return $this;
    }

    /**
     * @return PackageImporter
     */
    protected function importNameAndDescription()
    {
        // Truncate the language tags for this package
        $this->package->localizedTags()->delete();

        // Get the packagenames and packagedescriptions in all languages
        $tags = ['packagename' => 'name', 'packagedescription' => 'description'];
        foreach ($tags as $xml => $db) {
            foreach ($this->dom->getElements($xml) as $element) {
                $localizedTag = new LocalizedTag([
                    'tag' => $db,
                    'text' => $element->getElementValue($element),
                    'language' => $element->getElementAttribute($element, 'language'),
                ]);
                $localizedTag->package()->associate($this->package);
                $localizedTag->save();
            }
        }

        return $this;
    }

    /**
     * @return PackageImporter
     */
    protected function importVersion()
    {
        $version = PackageVersion::where('package_id', $this->package->id)->where('name', $this->versionNumber)->first();
        if (!$version) {
            $version = new PackageVersion([
                'name' => $this->versionNumber,
                'updatetype' => 'update', // Hardcoded
                'license' => 'free', // Hardcoded, for now
            ]);
            $version->package()->associate($this->package);
        }

        $version->timestamp = time();
        $version->save();

        $this->version = $version;

        return $this;
    }

    protected function importUpdatableVersions()
    {
        $version = $this->version;
        $version->updatableVersions()->delete();

        $instructions = $this->dom->getElements('instructions');
        foreach ($instructions as $instruction) {
            $type = $instruction->getElementAttribute($instruction, 'type');
            switch ($type) {
                case 'install':
                    continue;
                case 'update':
                    $updatable = new UpdatableVersion(['name' => $instruction->getElementAttribute($instruction, 'fromversion')]);
                    $updatable->version()->associate($version);
                    $updatable->save();
                    break;
                default:
                    throw new \Exception("LOL");
            }
        }

        return $this;
    }

    protected function importRequiredPackages()
    {
        $version = $this->version;
        $version->requiredPackages()->delete();

        $requirements = $this->dom->getElements('requiredpackage');
        foreach ($requirements as $requirement) {
            $object = new MentionedPackage([ 
                'identifier' => $requirement->getElementValue($requirement),
                'version' => $requirement->getElementAttribute($requirement, 'minversion'),
                'type' => 'required',
            ]);
            $object->version()->associate($version);
            $object->save();
        }

        return $this;
    }

    protected function importExcludedPackages()
    {
        $version = $this->version;
        $version->excludedPackages()->delete();

        $requirements = $this->dom->getElements('excludedpackage');
        foreach ($requirements as $requirement) {
            $object = new MentionedPackage([ 
                'identifier' => $requirement->getElementValue($requirement),
                'version' => $requirement->getElementAttribute($requirement, 'version'),
                'type' => 'excluded',
            ]);
            $object->version()->associate($version);
            $object->save();
        }

        return $this;
    }

    /**
     * Retrieves the stored package with the given identifier or creates a new one.
     * 
     * @param string $identifier The identifier for the package to be retrieved
     * @return Package
     */
    protected function buildPackage()
    {
        $package = Package::withIdentifier($this->identifier);
        if (!$package) {
            $package = new Package(['identifier' => $this->identifier]);
        }

        return $package;
    }
}