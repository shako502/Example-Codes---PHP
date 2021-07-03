<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://tskhadadzeshako.com
 * @since      1.0.0
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/public/partials
 */

 $adultsEnabled = get_option($prefix . 'adult');
 $childEnabled = get_option($prefix . 'child');
 $titleText = get_option($prefix . 'titleText');
 $buttonText = get_option($prefix . 'finalBtnText');
 $redURL = get_option($prefix . 'finalBtnURL');
 $colNumber = 2;
 if($adultsEnabled == '1'){
     $colNumber += 1;
 }
 if($childEnabled == '1'){
     $colNumber += 1;
 }

 $bgColor_style = '';
 if(!is_null($bgColor = get_option($prefix . 'bgColor', null)) && $bgColor !== '' ){
     $bgColor_style = 'style="background-color: '. $bgColor .'";';
 }

 $vsquareLayout = get_option($prefix . 'squareLayout');
 $mainContainerClass = 'parent-'. $colNumber;
 $submitSectionClass = 'checkinout-section-submit';
 if($vsquareLayout === '1'){
     $mainContainerClass = 'square-grid-' . $colNumber;
     $submitSectionClass = 'square-grid-submit';
 }
 
?>
<div class="checkinout-main-container" <?php echo $bgColor_style ?>>
    <div class="checkinout-section-title">
        <span><?php echo $titleText ?> </span>
    </div>
    <div class="<?php echo $mainContainerClass ?>">
        <div class="div1">
            <div class="checkinout-section-head">
                <span>Check In</span>
            </div>
            <div class="checkinout-section-input">
                <input type="text" class="checkinout-date-input" id="checkinout-checkin" /> 
            </div>
        </div>
        <div class="div2">
            <div class="checkinout-section-head">
                <span>Check Out</span>
            </div>
            <div class="checkinout-section-input">
                <input type="text" class="checkinout-date-input" id="checkinout-checkout" /> 
            </div>
        </div>
        <?php 
        if($adultsEnabled == '1'){?>
        <div class="div3">
            <div class="checkinout-section-head">
                <span>Adults</span>
            </div>
            <div class="checkinout-section-input">
                <input type="text" class="checkinout-number-input" readonly="true" value="0" id="checkinout-adults" /> 
            </div>
        </div>
        <?php 
        }
        if($childEnabled == '1'){?>
        <div class="div4">
            <div class="checkinout-section-head">
                <span>Children</span>
            </div>
            <div class="checkinout-section-input">
                <input type="text" class="checkinout-number-input" readonly="true" value="0" id="checkinout-child" /> 
            </div>
        </div>
        <?php
        } ?>
        <div class="<?php echo $submitSectionClass ?>">
            <input type="button" class="checkinout-submit" data-redURL="<?php echo $redURL ?>" id="checkinout-submit" value="<?php echo $buttonText ?>" />
        </div>
    </div>
</div>

<div id="numberTippy" style="display:none">
    <div class="checkinout-numbers">
        <button type="button" class="numberTippy-zero" value="0">0</button>
        <button type="button" value="1">1</button>
        <button type="button" value="2">2</button>
        <button type="button" value="3">3</button>
        <button type="button" value="4">4</button>
        <button type="button" value="5">5</button>
        <button type="button" value="6">6</button>
        <button type="button" value="7">7</button>
        <button type="button" value="8">8</button>
        <button type="button" value="9">9</button>
        <button type="button" value="10">10</button>
        <button type="button" value="11">11</button>
        <button type="button" value="12">12</button>
        <button type="button" value="13">13</button>
        <button type="button" value="14">14</button>
        <button type="button" value="15">15</button>
        <button type="button" value="16">16</button>
    </div>
</div>