<?php
require '../core/session.php';


$meta=[];
$meta['title']='Michael\'s Resume';

$content=<<<EOT
  <div id="titleName">
    <h3 id="nameTitle">MICHAEL HOWARD</h3>
  </div>

  <div id="addressWrapper">
    <div class="address">
      2300 Jackson St &#9900 
      Gary, IN 46303 &#9900 
      (800) 588-2300
    </div>
  </div>

    <div id="summary">
      <h4 id="titleCenter">Audio Recording Engineer</h4>

      <p>Engineer well versed in live studio recording, mixing, and mastering music compositions 
      of various genres.</p>

      <ul id="summaryList">
        <li>Setup and calibration of equipment</li>
        <li>Expertise in creating rough mixes and masters</li>
      </ul>
    </div>

    <div class="competences">
      <h4 id="titleCenter"><i>Core Competences</i></h4>

      <ul id="coreList" type="circle">
          <li>Proficent in Pro Tools</li>
          <li>Knowledgeable in audio plugins by multiple vendors</li>
      </ul>

      <ul id="coreList" type="circle">
          <li>Hardware and equipment trobleshooting</li>
          <li>Acoustics calibration</li>
      </ul>
    </div>

    <div id="certifications">
      <h4 id="titleCenter">CERTIFICATIONS / TECHNICAL PROFICIENCIES</h4>

      <div class="certBlock">
        <p><i>Certifications:</i></p>
        <p><i>Platforms:</i></p>
        <p><i>Tools:</i></p>
      </div>

      <div class="certBlock">
          <p>Master Audio Engineer I and II, Pro Tools Certified Engineer, Advanced Audio Technician III </p>
          <p>Mac OS, Windows</p>
          <p>Pro Tools, Logic, Nuendo Live</p>
      </div>
    </div>

    <div id="experience">
      <h4 id="titleCenter">PROFESSIONAL EXPERIENCE</h4>
      <div id="jobTimeline">
        <h4>Top Sound Studios -- Chicago, IL</h4> 
        <h4 class="jobDate">2017 -- Present</h4>
      
        <p>Top Sound Studios provides multimedia recording, mixing and mastering for various musical genres.</p>
      </div>
      <h4 class="jobTitle">Assistant Audio Engineer</h4>
        <ul id="jobTitleList">
          <li>Setup and maintenance of audio equipment</li>
          <li>Scheduling of studio time with clients</li>
          <li>Secondary recording functions during sessions</li>
          <li>Mixing and mastering assistance</li>
        </ul>
    </div>
EOT;

require '../core/layout.php';