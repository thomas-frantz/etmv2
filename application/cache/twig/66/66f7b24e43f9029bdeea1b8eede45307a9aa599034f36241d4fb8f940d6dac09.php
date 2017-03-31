<?php

/* main/dashboard_v.twig */
class __TwigTemplate_c86932ff495e3a47644437441d84a7c5ef9bbaa261fd57db10b0e5b026b6865a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?php
include_once 'assets/fusioncharts/php-wrapper/fusioncharts.php';
?>
<!--Fusioncharts -->
<script src=\"<?=base_url('assets/fusioncharts/js/fusioncharts.js')?>?HASH_CACHE=<?=HASH_CACHE?>\"></script>
<script src=\"<?=base_url('dist/js/apps/dashboard-app.js')?>?HASH_CACHE=<?=HASH_CACHE?>\"></script>
<section class=\"content\">
    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"view-header\">
                    <?php \$this->load->view('common/selector_v');?>
                    <div class=\"header-icon\">
                    <?php if(\$aggregate==0) {?>
                        <img class=\"character-portrait\" src= \"https://image.eveonline.com/Character/<?=\$character_id?>_64.jpg\" alt=\"character portrait\">
                    <?php } else {
                    ?>
                        <i class=\"pe page-header-icon pe-7s-shield\"></i>
                        <?php } ?>
                    </div>
                    <div class=\"header-title\">
                        <h1><?php echo \$aggregate == 1 ? implode(' + ', \$char_names) : \$character_name?>'s Dashboard</h1>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-2 col-xs-6\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <a href=\"<?=base_url('contracts/index/'.\$character_id.'?aggr='.\$aggregate.'&new='.\$new_info->contracts)?>\" class=\"no-ul\">
                            <h2 class=\"m-b-none\">
                                <i class=\"pe-7s-id\"></i>
                                <?=\$new_info->contracts?>
                                <span class=\"slight\">
                                    <?php if (\$new_info->contracts > 0) {
                                        echo \"<i class='fa fa-play fa-rotate-270 text-warning'></i>\";
                                    }
                                    ?>
                                </span>
                            </h2>
                        </a>
                        <div>New Contracts</div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-2 col-xs-6\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <a href=\"<?=base_url('transactions/index/'.\$character_id.'?aggr='.\$aggregate.'&new='.\$new_info->transactions)?>\" class=\"no-ul\">
                            <h2 class=\"m-b-none\">
                                <i class=\"pe-7s-menu\"></i>
                                <?=\$new_info->transactions?>
                                <span class=\"slight\">
                                    <?php if (\$new_info->transactions > 0) {
                                        echo \"<i class='fa fa-play fa-rotate-270 text-warning'></i>\";
                                    }
                                    ?>
                                </span>
                            </h2>
                        </a>
                        <div>New transactions</div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-2 col-xs-6\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <a href=\"<?=base_url('marketorders/index/'.\$character_id.'?aggr='.\$aggregate)?>\" class=\"no-ul\">
                            <h2 class=\"m-b-none\">
                                <i class=\"pe-7s-cart\"></i>
                                <?=\$new_info->orders?>
                                <span class=\"slight\">
                                    <?php if (\$new_info->orders > 0) {
                                        echo \"<i class='fa fa-play fa-rotate-270 text-warning'></i>\";
                                    }
                                    ?>
                                </span>
                            </h2>
                        </a>
                        <div>New orders</div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4 col-lg-offset-2 col-xs-12\">
                <div class=\"panel panel-filled\" style=\"position:relative;height: 114px\">
                    <div style=\"position: absolute;bottom: 0;left: 0;right: 0\">
                        <span class=\"sparkline\" data-profit=<?= \$week_profits?>></span>
                    </div>
                <div class=\"panel-body\">
                    <div class=\"m-t-sm\">
                        <div class=\"c-white\"><span class=\"label label-accent\"></span> Last 7 day profits (all characters)</div>
                        <span class=\"small c-white\">This week: <?=number_format(\$profits_trends['total_week'], 0) . \" ISK\";?>
                            <?php
                            \$profits_trends['trend_today'] > 0 ? \$res = \"270\" : \$res=\"90\"?>
                            <i class=\"fa fa-play fa-rotate-<?=\$res?> text-warning\"></i>
                            <?=number_format(\$profits_trends['trend_today'],0)?>% (today)
                        </span>
                    <!--<span class=\"sparkline\"></span>-->
                    </div>
                </div>
                </div>
            </div>

        </div>
        <div class=\"row\">
            <div class=\"col-lg-8\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <div class=\"panel panel-filled panel-c-success panel-collapse mt-20\">
                            <div class=\"dropdown pull-right mr-10 mt-10\">
                                <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdown-interval\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                                    Time Interval
                                    <span class=\"caret\"></span>
                                </button>
                                <ul class=\"dropdown-menu dropdown-menu-right dropdown-interval\">
                                  <li  data-id=\"1\"><a href=\"<?=base_url('dashboard/index/'.\$character_id.'/1?aggr='.\$aggregate)?>\">Last 24 hours</a></li>
                                  <li  data-id=\"3\"><a href=\"<?=base_url('dashboard/index/'.\$character_id.'/3?aggr='.\$aggregate)?>\">Last 3 days</a></li>
                                  <li  data-id=\"60\"><a href=\"<?=base_url('dashboard/index/'.\$character_id.'/7?aggr='.\$aggregate)?>\">Last 7 days</a></li>
                                </ul>
                            </div>
                            <div class=\"panel-heading\">
                                <h5><i class=\"fa fa-line-chart\"></i> Latest Profits - last <?=\$interval?> day(s)</h5>
                            </div>
                        </div>
                        <div class=\"table-responsive\">
                            <table id=\"profits-table\" class=\"table table-striped table-hover\">
                                <thead>
                                    <tr>
                                        <th style=\"width: 40%;\">Item</th>
                                        <th class=\"hidden-xs\">System</th>
                                        <th class=\"hidden-xs\">Date</th>
                                        <th class=\"hidden-xs\">Q</th>
                                        <th>Profit</th>
                                        <th>Margin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                      foreach (\$profits as \$row) {
                                            if(\$row['profit_unit'] >0 ? \$res = \"success\" : \$res=\"danger\");
                                            \$id = \$row['item_id'];
                                            \$img ? \$url = \$row['url'] : \$url=\"\";
                                          ?>
                                        <tr class=\"<?=\$res?>\">
                                            <td><?php echo \$img ? \"<img src=\".\$url.\" alt=''>\" : ''?>
                                                <?=\$row['item_name']?></td>
                                            <td class=\"hidden-xs\"><?=\$row['system_name']?></td>
                                            <td class=\"hidden-xs\"><?=\$row['sell_time']?></td>
                                            <td class=\"hidden-xs\"><?=number_format(\$row['quantity'],0)?></td>
                                            <td><?=number_format(\$row['profit_total'],2)?></td>
                                            <td><a class= \"btn btn-default btn-xs\"><?=number_format(\$row['margin'],2)?></a></td>
                                      </tr>
                                          <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4\">
                <?php
                    \$pieChart = new FusionCharts(\"pie2d\", \"mypiechart\", \"100%\", \"300\", \"pie\", \"json\", \$pie_data);
                    \$pieChart->render();
                ?>
                <div class=\"panel panel-filled panel-c-success panel-collapse\">
                    <div class=\"panel-heading\">
                        <h5><i class=\"fa fa-pie-chart\"></i>  Assets Distribution:</h5>
                    </div>
                </div>
                <div id=\"pie\">
                </div>
            </div>
        </div>
    </div>
</section>
";
    }

    public function getTemplateName()
    {
        return "main/dashboard_v.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<?php
include_once 'assets/fusioncharts/php-wrapper/fusioncharts.php';
?>
<!--Fusioncharts -->
<script src=\"<?=base_url('assets/fusioncharts/js/fusioncharts.js')?>?HASH_CACHE=<?=HASH_CACHE?>\"></script>
<script src=\"<?=base_url('dist/js/apps/dashboard-app.js')?>?HASH_CACHE=<?=HASH_CACHE?>\"></script>
<section class=\"content\">
    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"view-header\">
                    <?php \$this->load->view('common/selector_v');?>
                    <div class=\"header-icon\">
                    <?php if(\$aggregate==0) {?>
                        <img class=\"character-portrait\" src= \"https://image.eveonline.com/Character/<?=\$character_id?>_64.jpg\" alt=\"character portrait\">
                    <?php } else {
                    ?>
                        <i class=\"pe page-header-icon pe-7s-shield\"></i>
                        <?php } ?>
                    </div>
                    <div class=\"header-title\">
                        <h1><?php echo \$aggregate == 1 ? implode(' + ', \$char_names) : \$character_name?>'s Dashboard</h1>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-2 col-xs-6\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <a href=\"<?=base_url('contracts/index/'.\$character_id.'?aggr='.\$aggregate.'&new='.\$new_info->contracts)?>\" class=\"no-ul\">
                            <h2 class=\"m-b-none\">
                                <i class=\"pe-7s-id\"></i>
                                <?=\$new_info->contracts?>
                                <span class=\"slight\">
                                    <?php if (\$new_info->contracts > 0) {
                                        echo \"<i class='fa fa-play fa-rotate-270 text-warning'></i>\";
                                    }
                                    ?>
                                </span>
                            </h2>
                        </a>
                        <div>New Contracts</div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-2 col-xs-6\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <a href=\"<?=base_url('transactions/index/'.\$character_id.'?aggr='.\$aggregate.'&new='.\$new_info->transactions)?>\" class=\"no-ul\">
                            <h2 class=\"m-b-none\">
                                <i class=\"pe-7s-menu\"></i>
                                <?=\$new_info->transactions?>
                                <span class=\"slight\">
                                    <?php if (\$new_info->transactions > 0) {
                                        echo \"<i class='fa fa-play fa-rotate-270 text-warning'></i>\";
                                    }
                                    ?>
                                </span>
                            </h2>
                        </a>
                        <div>New transactions</div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-2 col-xs-6\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <a href=\"<?=base_url('marketorders/index/'.\$character_id.'?aggr='.\$aggregate)?>\" class=\"no-ul\">
                            <h2 class=\"m-b-none\">
                                <i class=\"pe-7s-cart\"></i>
                                <?=\$new_info->orders?>
                                <span class=\"slight\">
                                    <?php if (\$new_info->orders > 0) {
                                        echo \"<i class='fa fa-play fa-rotate-270 text-warning'></i>\";
                                    }
                                    ?>
                                </span>
                            </h2>
                        </a>
                        <div>New orders</div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4 col-lg-offset-2 col-xs-12\">
                <div class=\"panel panel-filled\" style=\"position:relative;height: 114px\">
                    <div style=\"position: absolute;bottom: 0;left: 0;right: 0\">
                        <span class=\"sparkline\" data-profit=<?= \$week_profits?>></span>
                    </div>
                <div class=\"panel-body\">
                    <div class=\"m-t-sm\">
                        <div class=\"c-white\"><span class=\"label label-accent\"></span> Last 7 day profits (all characters)</div>
                        <span class=\"small c-white\">This week: <?=number_format(\$profits_trends['total_week'], 0) . \" ISK\";?>
                            <?php
                            \$profits_trends['trend_today'] > 0 ? \$res = \"270\" : \$res=\"90\"?>
                            <i class=\"fa fa-play fa-rotate-<?=\$res?> text-warning\"></i>
                            <?=number_format(\$profits_trends['trend_today'],0)?>% (today)
                        </span>
                    <!--<span class=\"sparkline\"></span>-->
                    </div>
                </div>
                </div>
            </div>

        </div>
        <div class=\"row\">
            <div class=\"col-lg-8\">
                <div class=\"panel panel-filled\">
                    <div class=\"panel-body\">
                        <div class=\"panel panel-filled panel-c-success panel-collapse mt-20\">
                            <div class=\"dropdown pull-right mr-10 mt-10\">
                                <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdown-interval\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                                    Time Interval
                                    <span class=\"caret\"></span>
                                </button>
                                <ul class=\"dropdown-menu dropdown-menu-right dropdown-interval\">
                                  <li  data-id=\"1\"><a href=\"<?=base_url('dashboard/index/'.\$character_id.'/1?aggr='.\$aggregate)?>\">Last 24 hours</a></li>
                                  <li  data-id=\"3\"><a href=\"<?=base_url('dashboard/index/'.\$character_id.'/3?aggr='.\$aggregate)?>\">Last 3 days</a></li>
                                  <li  data-id=\"60\"><a href=\"<?=base_url('dashboard/index/'.\$character_id.'/7?aggr='.\$aggregate)?>\">Last 7 days</a></li>
                                </ul>
                            </div>
                            <div class=\"panel-heading\">
                                <h5><i class=\"fa fa-line-chart\"></i> Latest Profits - last <?=\$interval?> day(s)</h5>
                            </div>
                        </div>
                        <div class=\"table-responsive\">
                            <table id=\"profits-table\" class=\"table table-striped table-hover\">
                                <thead>
                                    <tr>
                                        <th style=\"width: 40%;\">Item</th>
                                        <th class=\"hidden-xs\">System</th>
                                        <th class=\"hidden-xs\">Date</th>
                                        <th class=\"hidden-xs\">Q</th>
                                        <th>Profit</th>
                                        <th>Margin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                      foreach (\$profits as \$row) {
                                            if(\$row['profit_unit'] >0 ? \$res = \"success\" : \$res=\"danger\");
                                            \$id = \$row['item_id'];
                                            \$img ? \$url = \$row['url'] : \$url=\"\";
                                          ?>
                                        <tr class=\"<?=\$res?>\">
                                            <td><?php echo \$img ? \"<img src=\".\$url.\" alt=''>\" : ''?>
                                                <?=\$row['item_name']?></td>
                                            <td class=\"hidden-xs\"><?=\$row['system_name']?></td>
                                            <td class=\"hidden-xs\"><?=\$row['sell_time']?></td>
                                            <td class=\"hidden-xs\"><?=number_format(\$row['quantity'],0)?></td>
                                            <td><?=number_format(\$row['profit_total'],2)?></td>
                                            <td><a class= \"btn btn-default btn-xs\"><?=number_format(\$row['margin'],2)?></a></td>
                                      </tr>
                                          <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-4\">
                <?php
                    \$pieChart = new FusionCharts(\"pie2d\", \"mypiechart\", \"100%\", \"300\", \"pie\", \"json\", \$pie_data);
                    \$pieChart->render();
                ?>
                <div class=\"panel panel-filled panel-c-success panel-collapse\">
                    <div class=\"panel-heading\">
                        <h5><i class=\"fa fa-pie-chart\"></i>  Assets Distribution:</h5>
                    </div>
                </div>
                <div id=\"pie\">
                </div>
            </div>
        </div>
    </div>
</section>
", "main/dashboard_v.twig", "C:\\xampp\\htdocs\\v2\\application\\views\\main\\dashboard_v.twig");
    }
}
