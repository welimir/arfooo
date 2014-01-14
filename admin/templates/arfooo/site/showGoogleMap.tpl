<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Google map</title>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
</head>
<body>

{if !empty($googleMap)}
<div id="map" style="width:600px; height:300px">
{$googleMap|htmlspecialchars_decode}
</div>
{/if}

</body>
</html>


