<!DOCTYPE html>
<html>
<head>
<style>
* {
    box-sizing: border-box;
  }

body{
    display: block;
    margin: 0px !important;
}

.column {
  float: left;
  width: 50%;
  height: 5.88CM;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

p{
    font-size: 10.5px;
    display: block;
    margin-block-start: 0em;
    margin-block-end: 0em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding: 1.5px;
} 

</style>

</head>
<body>
@for($i = 0; $i < 51; $i++)
<div class="row" style="margin-top: 2px">
  <div class="column" style="background-color:#aaa; border-right: dotted;">
    <div style="height:100%; text-overflow: ellipsis; overflow: hidden;">
        <p>Column 1</p>
        <p>Column 2</p>
        <p>Column 3</p>
    
    </div>
  </div>
  <div class="column" style="background-color:#aaa;">
    <h2>Column 2</h2>
  </div>
</div>
@endfor


</body>
</html>
