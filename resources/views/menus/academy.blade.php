
<li class="parent @if($sidebar == 'gems') active @endif">
	<a href="{{url('/gems')}}">
		<i class="icon-people icons "></i>
		<span>Gems</span>
	</a>
</li>

<li class="parent @if($sidebar == 'rudraksha') active @endif">
	<a href="{{url('/rudraksha')}}">
		<i class="icon-calendar icons "></i>
		<span>Rudraksha</span>
	</a>
</li>

<li class="parent @if($sidebar == 'diamond') active @endif">
	<a href="{{url('/diamond')}}">
		<i class="icon-calendar icons "></i>
		<span>Diamond</span>
	</a>
</li>

<li class="parent @if($sidebar == 'jewellery') active @endif">
	<a href="{{url('/jewellery')}}">
		<i class="icon-calendar icons "></i>
		<span>Jewellery</span>
	</a>
</li>

<li class="parent @if($sidebar == 'Anothers') active @endif">
	<a href="{{url('/Anothers')}}">
		<i class="icon-calendar icons "></i>
		<span>Anothers</span>
	</a>
</li>



<li class="parent @if($sidebar == 'management') active @endif" >
	<a  href="{{url('/management/customer-and-result')}}">
		<i class="icon-hourglass icons "></i>
		<span>Customer And Result</span>
	</a>
</li>

<li class="parent @if($sidebar == 'management') active @endif" >
	<a  href="{{url('/upload/front-back-image')}}">
		<i class="icon-hourglass icons "></i> 
		<span>Upload</span>
	</a>
</li>
