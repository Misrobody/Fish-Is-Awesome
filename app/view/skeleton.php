<!doctype html>
<html lang="en">

<head>
    <title>Fish Is Awesome</title>

    <!-- Core -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/favicon.ico">

    <!-- Primary Meta -->
    <meta name="title" content="Fish Is Awesome">
    <meta name="description" content="A lightweight local-first app to manage your fish inventory.">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Fish Is Awesome">
    <meta property="og:description" content="A lightweight local-first app to manage your fish inventory.">
    <meta property="og:url" content="https://example.com">
    <meta property="og:image" content="/images/cover.jpg">
    <meta property="og:site_name" content="Fish Is Awesome">
    <meta property="og:locale" content="en_US">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Fish Is Awesome">
    <meta name="twitter:description" content="A lightweight local-first app to manage your fish inventory.">
    <meta name="twitter:image" content="/images/cover.jpg">

    <!-- Browser UI -->
    <meta name="theme-color" content="#64153a">
    <meta name="color-scheme" content="light dark">
    <meta name="format-detection" content="telephone=no">

    <!-- iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Fish Is Awesome">

    <!-- Credits -->
    <link rel="author" href="/humans.txt">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
	<header>
		<h1>Fish is Awesome</h1>
	</header>
	
	<main>
		<nav>
			<ul>
				<li><a href="index.php?action=insert">Add a fish</a><br></li>
				<li><a href="index.php?action=liste">Fish list</a><br></li>
				<li><a href="index.php?action=extra">About</a><br></li>
			</ul>
		</nav>
		<div id="content">
		<?php echo $zonePrincipale ?>
		</div>
	</main>
	
</body>

</html>