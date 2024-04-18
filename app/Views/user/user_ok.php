<style>
    .circle-photo {
      width: 300px;
      height: 300px;
      border-radius: 50%;
      overflow: hidden;
      margin-right: 20px; 
      margin-left: 10px;
      float: left;
      border: 4px solid black;
      margin-top: -150px; 
      position: relative;
      z-index: 1;
    }

    .circle-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }
  </style>

<div class="card text-bg-dark">
  <img src="https://i.pinimg.com/originals/c6/9f/c8/c69fc85e56563e6ded204f8da3cbf110.jpg" class="card-img" alt="beauty notes" height="250px">
  <div class="card-img-overlay">
    <h1 class="card-title" style="text-align: center;"> <?=$name?> </h1>
  </div>
</div>
<div>
    <div class="circle-photo">
        <img src="https://i.pinimg.com/originals/d2/61/21/d2612159591ef243d0caf8e4758b78c2.jpg" alt="Profile Photo">
    </div>
    <div>
        <h3><?=$name?></h3>
        <h4><?=$description?></h4>
    </div>
</div>