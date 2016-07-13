<?xml version="1.0" encoding="UTF-8"?>
<!-- This XML file was generated by Padaroms WCF Package Update Server. You can find its source code at <https://github.com/padarom/wcf-update-server>. -->
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
            <version name="{!! $version->name !!}">
@if (count($version->compatibilityTree))
                <fromversions>
@foreach ($version->compatibilityTree as $earlierVersion)
                    <fromversion><![CDATA[{!! $earlierVersion->name !!}]]></fromversion>
@endforeach
                </fromversions>
@endif

@if (count($version->requirements))
                <requiredpackages>
@foreach ($version->requirements as $requirement)
                    <requiredpackage @if($requirement->min)minversion="{!! $requirement->min !!}"@endif><![CDATA[{!! $requirement->package !!}]]></requiredpackage>
@endforeach
                </requiredpackages>
@endif

                <updatetype><![CDATA[{!! $version->updatetype !!}]]></updatetype>
                <timestamp><![CDATA[{!! $version->timestamp !!}]]></timestamp>
                <versiontype><![CDATA[{!! $version->versiontype !!}]]></versiontype>
                <license><![CDATA[{!! $version->license !!}]]></license>
            </version>
@endforeach
        </versions>
    </package>

@endforeach
</section>