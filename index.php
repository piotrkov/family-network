<?php 
require_once 'src/UserHandler.php';

if(!isUserLoggedIn()){	
	header("location: login.php");
	exit;
}
?>
<html>
<head>
    <script type="text/javascript" src="vis-4.21.0/dist/vis.js"></script>
    <link href="vis-4.21.0/dist/vis.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        #mynetwork {
            width: 600px;
            height: 400px;
            border: 1px solid lightgray;
        }
		.network {
  display:inline-block;
  width:500px;
  height:500px;
  border:solid;
  background-color:white;
}
.report {
  display:inline-block;
  width:200px;
  vertical-align:top;
}
    </style>
</head>
<body>
<div id="mynetwork"></div>
<script type="text/javascript">
  // create an array with nodes
    /*var nodes = new vis.DataSet([
        {id: 1, label: 'Node 1'},
        {id: 2, label: 'Node 2'},
        {id: 3, label: 'Node 3'},
        {id: 4, label: 'Node 4'},
        {id: 5, label: 'Node 5'},
		 {id: 6, label: 'Node 5'},
		  {id: 7, label: 'Node 5'},
		   {id: 8, label: 'Node 5'},
		    {id: 9, label: 'Node 5'},
			 {id: 10, label: 'Node 5'},
			  {id: 11, label: 'Node 5'},
			   {id: 12, label: 'Node 5'}
			   , {id: 13, label: 'Node 5'},
			    {id: 14, label: 'Node 5'}
    ]);
*/
var nodesData = [];
for(var i = 1; i<16; i++){
	var level = 0;
	if(i == 1){
		level = 1;
	}
	nodesData.push({levle: level, id: i, label: 'Node '+i});
}

var nodes = new vis.DataSet(nodesData);
    // create an array with edges
    var edges = new vis.DataSet([
        {from: 1, to: 4},
		{from: 15, to: 4},
		{from: 4, to: 6},
		{from: 5, to: 6},
		{from: 2, to: 5},
		{from: 3, to: 5},
		{from: 2, to: 7},
		{from: 3, to: 7},
		{from: 7, to: 9},
		{from: 7, to: 10},
		{from: 8, to: 9},
		{from: 8, to: 10},
		{from: 9, to: 12},
		{from: 11, to: 12},
		{from: 13, to: 11},
		{from: 14, to: 11}
		
		
    ]);

    // create a network
    var container = document.getElementById('mynetwork');

    // provide the data in the vis format
    var data = {
        nodes: nodes,
        edges: edges
    };
    var options = {};

    // initialize your network!
    var network = new vis.Network(container, data, options);
	</script>

</body>
</html>



<?php ?>