<?xml version="1.0" encoding="UTF-8"?>
<section name="packages" xmlns="http://www.woltlab.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.woltlab.com https://www.woltlab.com/XSD/maelstrom/packageUpdateServer.xsd">

@foreach ($packages as $package)
    <package name="{{ $package->identifier }}">
        <packageinformation>
            <packagename><![CDATA[{!! $package->name !!}]]></packagename>
            <packagedescription><![CDATA[{!! $package->description !!}]]></packagedescription>
        </packageinformation>
        
        <authorinformation>
            <author><![CDATA[{!! $package->author !!}]]></author>
            <authorurl><![CDATA[{!! $package->authorurl !!}]]></authorurl>
        </authorinformation>

        <versions>
@foreach ($package->versions as $version)
            <version name="{!! $version->name !!}" accessible="{{ file_exists($version->storagePath) ? 'true' : 'false' }}">
@if (count($version->updatableVersions))
                <fromversions>
@foreach ($version->updatableVersions as $earlierVersion)
                    <fromversion><![CDATA[{!! $earlierVersion->name !!}]]></fromversion>
@endforeach
                </fromversions>
@endif
@if (count($version->requiredPackages))
                <requiredpackages>
@foreach ($version->requiredPackages as $requirement)
                    <requiredpackage @if($requirement->version)minversion="{!! $requirement->version !!}"@endif><![CDATA[{!! $requirement->identifier !!}]]></requiredpackage>
@endforeach
                </requiredpackages>
@endif
@if (count($version->excludedPackages))
                <excludedpackages>
@foreach ($version->excludedPackages as $excluded)
                    <excludedpackage @if($excluded->version)version="{!! $excluded->version !!}"@endif><![CDATA[{!! $excluded->identifier !!}]]></excludedpackage>
@endforeach
                </excludedpackages>
@endif
                <updatetype><![CDATA[{!! $version->updatetype !!}]]></updatetype>
                <timestamp><![CDATA[{!! $version->timestamp !!}]]></timestamp>
                <versiontype><![CDATA[{!! $version->versiontype !!}]]></versiontype>
                <license><![CDATA[{!! $version->license !!}]]></license>
                <filename><![CDATA[{{ $version->downloadURL }}]]></filename>
            </version>
@endforeach
        </versions>
    </package>

@endforeach
</section>