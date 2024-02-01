<?php

$UniProt = $_GET['query'];

echo <<<LABEL

<head>
<script type="text/javascript" src="static/molstar.js"></script>
<link rel="stylesheet" type="text/css" href="static/molstar.css"/>
</head>
<body>
<div id="app-id" class="molstar-app"></div>

<script type="text/javascript">
LABEL;
echo 'molstar.Viewer.create("app-id", {"viewportShowAnimation":true,"viewportShowSelectionMode":false,"layoutShowLeftPanel":false,"layoutShowLog":false,"layoutIsExpanded":false,"emdbProvider":"rcsb","layoutShowControls":false,"layoutShowSequence":false,"pdbProvider":"rcsb","layoutShowRemoteState":false,"viewportShowExpand":true}).then(viewer => {viewer.loadAlphaFoldDb(afdb="'.$UniProt.'")    });';
echo <<<LABEL
</script>

</body>

<style>
.molstar-app {
  width: 750px;
  height: 200px;
}
</style>


LABEL;
?>



