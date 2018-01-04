<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta name="MobileOptimized" content="width" />
<meta name="HandheldFriendly" content="true" />
<meta name="apple-mobile-web-app-capable" content="yes" />

@php
	$_keywords = "With,Buttercash,making,money,online,has,never,been,easier,easy,We,help,close,the,bridge,between,the,most,successfull,businesses,in,the,world,and,the,regular,content,consumers.,Check,this,out,to,see,how,it's,done.,Make,money,online,every,minute.,Time,is,money.";
	$_title = "Buttercash: Make money online daily.";
	$_image = url('/images/logo.sharable.png');
	$_description = "With Buttercash, making money online has never been easier. We help close the bridge between the most successful businesses in the world and the regular content consumers. Check this out to see how it's done. Make money online every minute. Time is money.";

@endphp

@if (is_array($_seo))
	<meta name="description" content="@yield('seoDescription')">
    <meta name="keywords" content="{{ $_keywords }} @yield('seoKeywords')">
    <meta name="author" content="{{ $_title }}">

	<meta itemprop="name" content="{{ config('app.name') }}: {{ $_seo['title'] }}">
	<meta itemprop="description" content="{{ $_seo['description'] }}">
	<meta itemprop="image" content="{{ $_seo['image'] }}">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@buttercash_">
	<meta name="twitter:title" content="{{ config('app.name') }}: {{ $_seo['title'] }}">
	<meta name="twitter:description" content="{{ $_seo['description'] }}">
	<meta name="twitter:creator" content="@author_handle">
	<meta name="twitter:image" content="{{ $_seo['image'] }}">
	<meta name="twitter:data1" content="$1.00">
	<meta name="twitter:label1" content="Price">
	<meta name="twitter:data2" content="{{ config('app.name') }}">
	<meta name="twitter:label2" content="{{ $_description }}">

	<!-- Open Graph data -->
	<meta property="og:title" content="{{ $_seo['title'] }}" />
	<meta property="article:publisher" content="https://www.facebook.com/officialbuttercash" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ Request::fullUrl() }}" />
	<meta property="og:image" content="{{ $_seo['image'] }}" />
	<meta property="og:description" content="{{ $_seo['description'] }}" />
	<meta property="og:site_name" content="{{ $_title }}" />
	<meta property="og:price:amount" content="1.00" />
	<meta property="og:price:currency" content="USD" />
@else

	<meta name="description" content="{{ $_description }}">
    <meta name="keywords" content="{{ $_keywords }}">
    <meta name="author" content="{{ $_title }}">

	<meta itemprop="name" content="{{ $_title }}">
	<meta itemprop="description" content="{{ $_description }}">
	<meta itemprop="image" content="{{ $_image }}">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@buttercash_">
	<meta name="twitter:title" content="{{ $_title }}">
	<meta name="twitter:description" content="{{ $_description }}">
	<meta name="twitter:creator" content="@author_handle">
	<meta name="twitter:image" content="{{ $_image }}">
	<meta name="twitter:data1" content="$1.00">
	<meta name="twitter:label1" content="Price">
	<meta name="twitter:data2" content="{{ $_title }}">
	<meta name="twitter:label2" content="{{ $_description }}">

	<!-- Open Graph data -->
	<meta property="og:title" content="{{ $_title }}" />
	<meta property="article:publisher" content="https://www.facebook.com/officialbuttercash" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ Request::fullUrl() }}" />
	<meta property="og:image" content="{{ $_image }}" />
	<meta property="og:description" content="{{ $_description }}" />
	<meta property="og:site_name" content="{{ $_title }}" />
	<meta property="og:price:amount" content="1.00" />
	<meta property="og:price:currency" content="USD" />
@endif
