<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://tskhadadzeshako.com
 * @since      1.0.0
 *
 * @package    Checkinoutpicker
 * @subpackage Checkinoutpicker/admin/partials
 */

 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !current_user_can( 'manage_options' ) ) {
	return;
}

$nChild = $options_prefix . 'child';
$nAdult = $options_prefix . 'adult';
$nBorderSize = $options_prefix . 'border';
$nBorderColor = $options_prefix . 'borderC';
$nCustomCSS = $options_prefix . 'customCSS';
$nbgColor = $options_prefix . 'bgColor';
$nfontColor = $options_prefix . 'fontColor';
$nbtnBgColor = $options_prefix . 'btnBgColor';
$nbtnHoverColor = $options_prefix . 'btnHoverColor';
$nbtnHoverTxtC = $options_prefix . 'btnHoverTxtC';
$nbtnTxtC = $options_prefix . 'btnTxtC';
$ngFont = $options_prefix . 'gFont';
$ngFontEnable = $options_prefix . 'gFontEnable';
$ntitleText = $options_prefix . 'titleText';
$nbgColorNumbers = $options_prefix . 'nBgColor';
$nbgContNumbers = $options_prefix . 'nContBgColor';
$ntextColNumbers = $options_prefix . 'nTextColor';
$nfinalBtnText = $options_prefix . 'finalBtnText';
$nfinalBtnURL = $options_prefix . 'finalBtnURL';
$ncalBg = $options_prefix . 'calBg';
$ncalActive = $options_prefix . 'calActive';
$ncalBefore = $options_prefix . 'calBefore';
$ncalAfter = $options_prefix . 'calAfter';
$ncalActiveText = $options_prefix . 'calActiveText';
$ncalBeforeText = $options_prefix . 'calBeforeText';
$ncalAfterText = $options_prefix . 'calAfterText';
$nsquareLayout = $options_prefix . 'squareLayout';
$nsqrLayoutSize = $options_prefix . 'sqrLayoutSize';
$nqueryAdults = $options_prefix . 'queryAdults';
$nqueryChild = $options_prefix . 'queryChild';
$nqueryCheckin = $options_prefix . 'queryCheckin';
$nqueryCheckout = $options_prefix . 'queryCheckout';


$vChild = get_option($nChild);
$vAdult = get_option($nAdult);
$vBorderSize = get_option($nBorderSize);
$vBorderColor = get_option($nBorderColor);
$vCustomCSS = get_option($nCustomCSS);
$vbgColor = get_option($nbgColor);
$vfontColor = get_option($nfontColor);
$vbtnBgColor = get_option($nbtnBgColor);
$vbtnHoverColor = get_option($nbtnHoverColor);
$vbtnHoverTxtC = get_option($nbtnHoverTxtC);
$vbtnTxtC = get_option($nbtnTxtC);
$vgFont = get_option($ngFont);
$vgFontEnable = get_option($ngFontEnable);
$vtitleText = get_option($ntitleText);
$vbgColorNumbers = get_option($nbgColorNumbers);
$vbgContNumbers = get_option($nbgContNumbers);
$vtextColNumbers = get_option($ntextColNumbers);
$vfinalBtnText = get_option($nfinalBtnText);
$vfinalBtnURL = get_option($nfinalBtnURL);
$vcalBg = get_option($ncalBg);
$vcalActive = get_option($ncalActive);
$vcalBefore = get_option($ncalBefore);
$vcalAfter = get_option($ncalAfter);
$vcalActiveText = get_option($ncalActiveText);
$vcalBeforeText = get_option($ncalBeforeText);
$vcalAfterText = get_option($ncalAfterText);
$vsquareLayout = get_option($nsquareLayout);
$vsqrLayoutSize = get_option($nsqrLayoutSize);
$vqueryAdults = get_option($nqueryAdults);
$vqueryChild = get_option($nqueryChild);
$vqueryCheckin = get_option($nqueryCheckin);
$vqueryCheckout = get_option($nqueryCheckout);
?>

<div class="wrap">
    <div class="row">
        <div class="col d-flex justify-content-center">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        </div>
    </div>
    <form method="post" action="options.php">
        <?php
			settings_fields( $options_prefix . 'options' );
		?>
        <div class="form-row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Child Input Option:</h5>
                                <div class="form-check">
                                    <input type="checkbox" value="1" <?php checked(1, $vChild, true)?> name="<?php echo $nChild ?>" id="<?php echo $nChild ?>" class="form-check-label" />
                                    <label for="<?php echo $nChild ?>">Enable</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Adult Input Option:</h5>
                                <div class="form-check">
                                    <input type="checkbox" value="1" <?php checked(1, $vAdult, true)?> name="<?php echo $nAdult ?>" id="<?php echo $nAdult ?>"  />
                                    <label for="<?php echo $nAdult ?>" class="form-check-label">Enable</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Choose Google Font:</h5>
                                <input type="checkbox" value="1" <?php checked(1, $vgFontEnable, true) ?> name="<?php echo $ngFontEnable ?>" />
                                <label for="<?php echo $ngFontEnable ?>">Enable</label>
                                <select id="googleFontsPicker" class="form-control" name="<?php echo $ngFont ?>">
                                </select>
                                <span>Selected Font: <span id="selectedFont"><?php echo $vgFont ?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Title Text:</h5>
                                <div class="d-flex flex-column">
                                    <label for="<?php echo $ntitleText ?>">Text:</label>
                                    <input type="text" class="form-control" value="<?php echo $vtitleText ?>" name="<?php echo $ntitleText ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card" style="max-width: 100%; min-height: 40rem;">
                            <div class="card-body">
                                <h5 class="card-title">Custom CSS: </h5>
                                <textarea name="<?php echo $nCustomCSS ?>" class="sccss-content" id="<?php echo $nCustomCSS ?>"><?php echo esc_html( $vCustomCSS ); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Calendar Options: </h5>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label for="<?php echo $ncalBg ?>">Calendar Background Color: </label>
                                            <input type="text" value="<?php echo $vcalBg ?>" name="<?php echo $ncalBg ?>" id="<?php echo $ncalBg ?>" class="form-control checkinoutColorPicker" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label for="<?php echo $ncalActive ?>">Active Date Background Color: </label>
                                            <input type="text" value="<?php echo $vcalActive ?>" name="<?php echo $ncalActive ?>" id="<?php echo $ncalActive ?>" class="form-control checkinoutColorPicker" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label for="<?php echo $ncalActiveText ?>">Active Date Text Color: </label>
                                            <input type="text" value="<?php echo $vcalActiveText ?>" name="<?php echo $ncalActiveText ?>" id="<?php echo $ncalActiveText ?>" class="form-control checkinoutColorPicker" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label for="<?php echo $ncalBefore ?>">Previous Date Background Color: </label>
                                            <input type="text" value="<?php echo $vcalBefore ?>" name="<?php echo $ncalBefore ?>" id="<?php echo $ncalBefore ?>" class="form-control checkinoutColorPicker" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label for="<?php echo $ncalBeforeText ?>">Previous Date Text Color: </label>
                                            <input type="text" value="<?php echo $vcalBeforeText ?>" name="<?php echo $ncalBeforeText ?>" id="<?php echo $ncalBeforeText ?>" class="form-control checkinoutColorPicker" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label for="<?php echo $ncalAfter ?>">Next Date Background Color: </label>
                                            <input type="text" value="<?php echo $vcalAfter ?>" name="<?php echo $ncalAfter ?>" id="<?php echo $ncalAfter ?>" class="form-control checkinoutColorPicker" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex flex-column">
                                            <label for="<?php echo $ncalAfterText ?>">Next Date Text Color: </label>
                                            <input type="text" value="<?php echo $vcalAfterText ?>" name="<?php echo $ncalAfterText ?>" id="<?php echo $ncalAfterText ?>" class="form-control checkinoutColorPicker" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body stylingCard">
                                <h5 class="card-title">Number Picker Styling:</h5>
                                <div class="form-group">
                                    <label for="<?php echo $nbgColorNumbers ?>">Numbers Background Color: </label>
                                    <input type="text" value="<?php echo $vbgColorNumbers ?>" name="<?php echo $nbgColorNumbers ?>" id="<?php echo $nbgColorNumbers ?>" class="form-control checkinoutColorPicker" />
                                </div>
                                <div class="form-group">
                                    <label for="<?php echo $nbgContNumbers ?>">Numbers Container Background Color: </label>
                                    <input type="text" value="<?php echo $vbgContNumbers ?>" name="<?php echo $nbgContNumbers ?>" id="<?php echo $nbgContNumbers ?>" class="form-control checkinoutColorPicker" />
                                </div>
                                <div class="form-group">
                                    <label for="<?php echo $ntextColNumbers ?>">Numbers Font Color: </label>
                                    <input type="text" value="<?php echo $vtextColNumbers ?>" name="<?php echo $ntextColNumbers ?>" id="<?php echo $ntextColNumbers ?>" class="form-control checkinoutColorPicker" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Button Options: </h5>
                        <div class="d-flex flex-column">
                            <label for="<?php echo $nfinalBtnText ?>">Button Text:</label>
                            <input type="text" class="form-control" value="<?php echo $vfinalBtnText ?>" name="<?php echo $nfinalBtnText ?>" />
                        </div>
                        <div class="d-flex flex-column">
                            <label for="<?php echo $nfinalBtnURL ?>">Redirection URL:</label>
                            <input type="text" class="form-control" value="<?php echo $vfinalBtnURL ?>" name="<?php echo $nfinalBtnURL ?>" />
                        </div>
                        <h5 class="mt-3">Query Parametes</h5>
                        <div class="d-flex flex-column">
                            <label for="<?php echo $nqueryAdults ?>">Qury Parameter - Adults:</label>
                            <input type="text" class="form-control" value="<?php echo $vqueryAdults ?>" name="<?php echo $nqueryAdults ?>" />
                        </div>
                        <div class="d-flex flex-column">
                            <label for="<?php echo $nqueryChild ?>">Qury Parameter - Child:</label>
                            <input type="text" class="form-control" value="<?php echo $vqueryChild ?>" name="<?php echo $nqueryChild ?>" />
                        </div>
                        <div class="d-flex flex-column">
                            <label for="<?php echo $nqueryCheckin ?>">Qury Parameter - CheckIn:</label>
                            <input type="text" class="form-control" value="<?php echo $vqueryCheckin ?>" name="<?php echo $nqueryCheckin ?>" />
                        </div>
                        <div class="d-flex flex-column">
                            <label for="<?php echo $nqueryCheckout ?>">Qury Parameter - CheckOut:</label>
                            <input type="text" class="form-control" value="<?php echo $vqueryCheckout ?>" name="<?php echo $nqueryCheckout ?>" />
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Squared Layout: </h5>
                        <div class="form-check">
                            <input type="checkbox" value="1" <?php checked(1, $vsquareLayout, true)?> name="<?php echo $nsquareLayout ?>" id="<?php echo $nsquareLayout ?>" class="form-check-label" />
                            <label for="<?php echo $nsquareLayout ?>">Enable</label>
                        </div>
                        <div class="d-flex flex-column">
                            <label for="<?php echo $nsqrLayoutSize ?>">Container Size (px):</label>
                            <input type="number" value="<?php echo $vsqrLayoutSize ?>" name="<?php echo $nsqrLayoutSize ?>" id="<?php echo $nsqrLayoutSize ?>" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body stylingCard">
                        <h5 class="card-title">Styling:</h5>
                        <div class="form-group">
                            <label for="<?php echo $nbgColor ?>">Background Color: </label>
                            <input type="text" value="<?php echo $vbgColor ?>" name="<?php echo $nbgColor ?>" id="<?php echo $nbgColor ?>" class="form-control checkinoutColorPicker" />
                        </div>
                        
                        <div class="form-group">
                            <label for="<?php echo $nBorderSize ?>">Border Size (px):</label>
                            <input type="number" value="<?php echo $vBorderSize ?>" name="<?php echo $nBorderSize ?>" id="<?php echo $nBorderSize ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $nBorderColor ?>">Border Color: </label>
                            <input type="text" value="<?php echo $vBorderColor ?>" name="<?php echo $nBorderColor ?>" id="<?php echo $nBorderColor ?>" class="form-control checkinoutColorPicker" />
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $nfontColor ?>">Font Color: </label>
                            <input type="text" value="<?php echo $vfontColor ?>" name="<?php echo $nfontColor ?>" class="form-control checkinoutColorPicker" />
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $nbtnBgColor ?>">Button Color: </label>
                            <input type="text" value="<?php echo $vbtnBgColor ?>" name="<?php echo $nbtnBgColor ?>" class="form-control checkinoutColorPicker" />
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $nbtnTxtC ?>">Button Font Color: </label>
                            <input type="text" value="<?php echo $vbtnTxtC ?>" name="<?php echo $nbtnTxtC ?>" class="form-control checkinoutColorPicker" />
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $nbtnHoverColor ?>">Button Hover Color: </label>
                            <input type="text" value="<?php echo $vbtnHoverColor ?>" name="<?php echo $nbtnHoverColor ?>" class="form-control checkinoutColorPicker" />
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $nbtnHoverTxtC ?>">Button Hover Text Color: </label>
                            <input type="text" value="<?php echo $vbtnHoverTxtC ?>" name="<?php echo $nbtnHoverTxtC ?>" class="form-control checkinoutColorPicker" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <?php submit_button(); ?>
            </div>
        </div>
    </form>
</div>


<!-- This file should primarily consist of HTML with a little bit of PHP. -->
