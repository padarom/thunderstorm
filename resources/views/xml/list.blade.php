<?xml version="1.0" encoding="UTF-8"?>
<section name="packages" xmlns="http://www.woltlab.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.woltlab.com https://www.woltlab.com/XSD/packageUpdateServer.xsd">

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
    </package>

    <versions>
@foreach ($package->versions as $version)

@endforeach
    </versions>
@endforeach

</section>