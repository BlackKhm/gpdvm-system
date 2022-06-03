
<style>
    .carousel-inner {
	width: 100%;
	display: inline-block;
	position: relative;
}
.carousel-inner {
	padding-top: 43.25%;
	display: block;
	content: "";
}
.carousel-item {
	position: absolute;
	top: 0;
	bottom: 0;
	right: 0;
	left: 0;
	background: skyblue;
	background: no-repeat center center scroll;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

.caption {
	position: absolute;
	top: 50%;
	left: 50%;
    transform: translateX(-50%) translateY(-50%);
	width: 60%;
	z-index: 9;
	margin-top: 20px;
	text-align: center;
}
.caption h1 {
  color: #fff;
	font-size: 52px;
	font-weight: 700;
	margin-bottom: 23px;
}
.caption h2 {
  color: rgba(255,255,255,.75);
	font-size: 26px;
	font-weight: 300;
}
a.big-button {
	color: #fff;
	font-size: 19px;
	font-weight: 700;
	text-transform: uppercase;
	background: #eb7a00;
	background: rgba(255, 0, 0, 0.75);
	padding: 28px 35px;
	border-radius: 3px;
	margin-top: 80px;
	margin-bottom: 0;
	display: inline-block;
}
a.big-button:hover {
	text-decoration: none;
	background: rgba(255, 0, 0, 0.9);
}
a.view-demo {
	color: #fff;
	font-size: 21px;
	font-weight: 700;
	display: inline-block;
	margin-top: 35px;
}
a.view-demo:hover {
	text-decoration: none;
	color: #333;
}

.carousel-indicators .active {
  background: #fff;
}
.carousel-indicators li {
  background: rgba(255, 255, 255, 0.4);
  border-top: 20px solid;
  z-index: 15;
}
</style>

<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel" data-slide-to="0" class="active"></li>
      <li data-target="#carousel" data-slide-to="1"></li>
      <li data-target="#carousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">

      <div class="carousel-item active" style="background-image: url('https://rhac.org.kh/wp-content/uploads/2018/11/Untitled-1.jpg'); background-size: cover;">
        {{-- <div class="caption">
          <h1>Create and share your whatever</h1>
          <h2>Make it easy for you to do whatever this thing does.</h2>
        </div> --}}
      </div>
      

      <div class="carousel-item" style="background-image: url('https://rhac.org.kh/wp-content/uploads/2019/10/slide-3.jpg'); background-size: cover;">
        {{-- <div class="caption">
          <h1>Something and share your whatever</h1>
          <h2>Else it easy for you to do whatever this thing does.</h2>
        </div> --}}
      </div>
      
      
      <div class="carousel-item" style="background-image: url('https://rhac.org.kh/wp-content/uploads/2017/08/Clinic-2.jpg'); background-size: cover;">
        {{-- <div class="caption">
          <h1>Create and share your whatever</h1>
          <h2>Make it easy for you to do whatever this thing does.</h2>
        </div> --}}
      </div>

    </div>
    
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>