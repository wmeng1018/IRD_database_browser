<?php

$query = $_GET['query'];

$mysqli = mysqli_connect("host", "user", "pass", "db", "3306") or die ("Connection Error");

$test = $mysqli->query("select id,geneID,gnomad_AF,annotation,cDNA_change,aa_change,chr,pos,ref,alt,Polyphen2,SIFT,rs_dbSNP,REVEL_score,MutationAssessor,CADD_score,ClinPred_score,MutPred_score,spliceAI_score,Mutscore from variants where id='$query' or cDNA_change='$query' or aa_change='$query'limit 1 ");

$testing=$test->fetch_assoc();
$gene = $testing["geneID"];
$anno = $testing["annotation"];
$cDNA = $testing["cDNA_change"];
$aa = $testing["aa_change"];
$variant = $testing["id"];
$chr = $testing["chr"];
$pos = $testing["pos"];
$ref = $testing["ref"];
$alt = $testing["alt"];
$ClinPred = $testing["ClinPred_score"];
$MutPred = $testing["MutPred_score"];
$rs_dbSNP = $testing["rs_dbSNP"];
$Polyphen = $testing["Polyphen2"];
$SIFT = $testing["SIFT"];
$REVEL = $testing["REVEL_score"];
$MutationAssessor = $testing["MutationAssessor"];
$CADD = $testing["CADD_score"];
$VEST = $testing["VEST4_score"];
$Mutscore = $testing["Mutscore"];
$spliceAI = $testing["spliceAI_score"];
$gnomad = $testing["gnomad_AF"];

if($variant == null){ 
     include('not_found.html');
}else{

#$test1 = $mysqli->query("select variantID,cohort_het,cohort_hom,cohort_AN, cohort_AC, cohort_AF from AF where variantID='$variant' ");
$test1 = $mysqli->query("select 2*count(distinct id) AS cohort_AN from probands ");
$test2 = $mysqli->query("select count(distinct probandID) AS cohort_het from proband_variant where variantID='$variant' and genotype like 'het%' ");
$test3 = $mysqli->query("select count(distinct probandID) AS cohort_hom from proband_variant where variantID='$variant' and genotype like 'hom%' ");
$test4 = $mysqli->query("select count(distinct probandID) AS cohort_hem from proband_variant where variantID='$variant' and genotype like 'hem%' ");
$testing1=$test1->fetch_assoc();
$testing2=$test2->fetch_assoc();
$testing3=$test3->fetch_assoc();
$testing4=$test4->fetch_assoc();
$AN = $testing1["cohort_AN"];
$hom = $testing3["cohort_hom"];
$het = $testing2["cohort_het"];
$hem = $testing4["cohort_hem"];
$AC = 2*$hom+$het+$hem;
$AF = $AC/$AN;
$hom = $hom + $hem;

$test5 = $mysqli->query("select 2*count(distinct id) AS cohort_AN from probands where cohortID='Chen_lab'");
$test6 = $mysqli->query("select count(distinct pv.probandID) AS cohort_het from proband_variant AS pv inner join probands AS p on pv.probandID=p.id where p.cohortID='Chen_lab' and pv.variantID='$variant' and pv.genotype like 'het%' ");
$test7 = $mysqli->query("select count(distinct pv.probandID) AS cohort_hom from proband_variant AS pv inner join probands AS p on pv.probandID=p.id where p.cohortID='Chen_lab' and pv.variantID='$variant' and pv.genotype like 'hom%' ");
$test8 = $mysqli->query("select count(distinct pv.probandID) AS cohort_hem from proband_variant AS pv inner join probands AS p on pv.probandID=p.id where p.cohortID='Chen_lab' and pv.variantID='$variant' and pv.genotype like 'hem%' ");
$testing5=$test5->fetch_assoc();
$testing6=$test6->fetch_assoc();
$testing7=$test7->fetch_assoc();
$testing8=$test8->fetch_assoc();
$Chen_lab_AN = $testing5["cohort_AN"];
$Chen_lab_hom = $testing7["cohort_hom"];
$Chen_lab_het = $testing6["cohort_het"];
$Chen_lab_hem = $testing8["cohort_hem"];
$Chen_lab_AC = 2*$Chen_lab_hom+$Chen_lab_het+$Chen_lab_hem;
$Chen_lab_AF = $Chen_lab_AC/$Chen_lab_AN;
$Chen_lab_hom = $Chen_lab_hom + $Chen_lab_hem;

$test9 = $mysqli->query("select 2*count(distinct id) AS cohort_AN from probands where cohortID='NEI_eyeGENE' ");
$test10 = $mysqli->query("select count(distinct pv.probandID) AS cohort_het from proband_variant AS pv inner join probands AS p on pv.probandID=p.id where p.cohortID='NEI_eyeGENE' and pv.variantID='$variant' and pv.genotype like 'het%' ");
$test11 = $mysqli->query("select count(distinct pv.probandID) AS cohort_hom from proband_variant AS pv inner join probands AS p on pv.probandID=p.id where p.cohortID='NEI_eyeGENE' and pv.variantID='$variant' and pv.genotype like 'hom%' ");
$test12 = $mysqli->query("select count(distinct pv.probandID) AS cohort_hem from proband_variant AS pv inner join probands AS p on pv.probandID=p.id where p.cohortID='NEI_eyeGENE' and pv.variantID='$variant' and pv.genotype like 'hem%' ");
$testing9=$test9->fetch_assoc();
$testing10=$test10->fetch_assoc();
$testing11=$test11->fetch_assoc();
$testing12=$test12->fetch_assoc();
$NEI_eyeGENE_AN = $testing9["cohort_AN"];
$NEI_eyeGENE_hom = $testing11["cohort_hom"];
$NEI_eyeGENE_het = $testing10["cohort_het"];
$NEI_eyeGENE_hem = $testing12["cohort_hem"];
$NEI_eyeGENE_AC = 2*$NEI_eyeGENE_hom+$NEI_eyeGENE_het+$NEI_eyeGENE_hem;
$NEI_eyeGENE_AF = $NEI_eyeGENE_AC/$NEI_eyeGENE_AN;
$NEI_eyeGENE_hom = $NEI_eyeGENE_hom + $NEI_eyeGENE_hem;



echo <<<LABEL

<head>
    <title>Inherited Retina Disease Genetic Variant Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="static/images/icon.png" type="image/x-icon">
    <link rel="icon" href="static/images/icon.png" type="image/x-icon">
    <link rel=stylesheet type=text/css href="static/typeaheadjs.css">
    <link rel=stylesheet type=text/css href="static/css/font-awesome.min.css">
    <script type="text/javascript" src="static/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="static/bootstrap.min.js"></script>
    <script type="text/javascript" src="static/typeahead.bundle.min.js"></script>

    <script type="text/javascript" src="static/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="static/jquery.tablesorter.pager.js"></script>
    <link rel=stylesheet type=text/css href="static/theme.default.css">
    <script type="text/javascript" src="static/underscore-min.js"></script>

    <link rel=stylesheet type=text/css href="static/bootstrap.min.css">
    <link rel=stylesheet type=text/css href="static/style.css">
    <script type="text/javascript" src="static/d3.v3.min.js"></script>
    <script type="text/javascript" src="static/index.js"></script>
    <script type="text/javascript" src="static/exac.js"></script>
    <script type="text/javascript">
        number_of_samples = 6060;
        release_number = 1.0;
        number_of_samples_full = 6060;
        $(document).ready(function() {
            $('.number_samples').html(Number(number_of_samples).toLocaleString('en'));
            $('.number_samples_full').html(Number(number_of_samples_full).toLocaleString('en'));
            $('.release_number').html(Number(release_number).toLocaleString('en'));
        });
        $(function() {
            var bestPictures = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              remote: '/autocomplete/%QUERY'
            });

            bestPictures.initialize();

            $('.awesomebar').typeahead(
                {
                    autoselect: true,
                },
                {
                    name: 'best-pictures',
                    displayKey: 'value',
                    source: bestPictures.ttAdapter(),
                }
            );
            $('.awesomebar').bind('typeahead:selected', function(obj, datum) {
                window.location.href = '/awesome?query=' + datum.value;
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation" style="background: #103173;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="main.html" style="color: white; font-weight: bold; float: left; font-size: 15px;">IRD Genetic Variant Database</a>
            
            <div class="col-xs-5" id="navbar_form_container">
                <form action="variant.php" class="navbar-form" role="search">
                    <div class="form-group" id="navbar-awesomebar">
                        <input type="submit" style="display: none;"/>
                        <input id="navbar-searchbox-input" name="query" class="form-control awesomebar" type="text" placeholder="Variant: chr:pos:ref:alt"/>
                        <input type="submit" style="position: absolute; left: -9999px"/>
                    </div>
                </form>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
    </div><!-- /.container-fluid -->
</nav>


    <style>
    .d3_graph {
        font: 10px sans-serif;
    }

    .bar rect {
        fill: steelblue;
        shape-rendering: crispEdges;
    }

    .bar text {
        fill: #fff;
    }

    .axis path, .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
    }
    </style>
     <script>
        var af_buckets = [0.0001, 0.0002, 0.0005, 0.001, 0.002, 0.005, 0.01, 0.02, 0.05, 0.1, 0.2, 0.5, 1];
        function get_af_bucket_text(bin) {
            if (bin == 'singleton' || bin == 'doubleton') {
                return 'This is the site quality distribution for all ' + bin + 's in Iranome.';
            } else if (bin == '0.0001') {
                return 'This is the site quality distribution for all variants with AF < ' + bin + ' in Iranome.';
            } else {
                return 'This is the site quality distribution for all variants with ' + af_buckets[af_buckets.indexOf(parseFloat(bin)) - 1] + ' < AF < ' + bin + ' in Iranome.';
            }
        }

        $(document).ready(function() {
            $('.frequency_display_buttons').change(function() {
                $('.frequency_displays').hide();
                var v = $(this).attr('id').replace('_button', '');
                $('#' + v + '_container').show();
            });
            $('#frequency_table').tablesorter({
                sortList: [[7,1], [0,0]]
            });

            //if (window.variant != null && 'genotype_depths' in window.variant) {
			if (window.variant != null) {
				if ('genotype_depths' in window.variant) {
                	draw_quality_histogram(window.variant.genotype_depths[1], '#quality_display_container', false);
				}
                $('.quality_display_buttons').change(function() {
                    var v = $(this).attr('id').replace('_button', '');
                    var f = $('.quality_full_site_buttons.active').attr('id') == 'variant_site_button' ? 0 : 1;
                    draw_quality_histogram(window.variant[v][f], '#quality_display_container', false);
                });
                $('.quality_full_site_buttons').change(function() {
                    var v = $('.quality_display_buttons.active').attr('id').replace('_button', '');
                    var f = $(this).attr('id') == 'variant_site_button' ? 0 : 1;
                    draw_quality_histogram(window.variant[v][f], '#quality_display_container', false);
                });

                // Quality metric histograms

                var data = _.zip(_.map(window.metrics['Site Quality']['mids'], Math.exp), window.metrics['Site Quality']['hist']);
                console.log(data);
                draw_quality_histogram(data, '#quality_metric_container', true);
                var bin = window.metrics['Site Quality']['metric'].split('_')[1];
                $('#site_quality_note').html(get_af_bucket_text(bin));
                var pos = $('#quality_metric_select').val().split(': ')[1];
                add_line_to_quality_histogram(data, pos, '#quality_metric_container', true);
                $('#quality_metric_select').change(function() {
                    var v = $(this).val().split(': ');
                    var log = false;
                    var data;
                    if (v[0] == 'Site Quality') {
                        data = _.zip(_.map(window.metrics[v[0]]['mids'], Math.exp), window.metrics[v[0]]['hist']);
                        log = true;
                        var bin = window.metrics['Site Quality']['metric'].split('_')[1];
                        $('#site_quality_note').html(get_af_bucket_text(bin));
                    } else {
                        data = _.zip(window.metrics[v[0]]['mids'], window.metrics[v[0]]['hist']);
                        if (v[0] == 'Strand Bias-Fisher\'s (FS)') 
                            $('#site_quality_note').html('Phred-scaled p-value using Fisher\'s exact test to detect strand bias. This distribution represents all variants in iranome.');
                        else if (v[0] == 'BaseQRankSum')
                            $('#site_quality_note').html('Z-score from Wilcoxon rank sum test of Alt Vs. Ref base qualities. This distribution represents all variants in iranome.');
                        else if (v[0] == 'MQRankSum')
                            $('#site_quality_note').html('Z-score From Wilcoxon rank sum test of Alt vs. Ref read mapping qualities. This distribution represents all variants in iranome.');
                        else if (v[0] == 'Mapping Qual (MQ)')
                            $('#site_quality_note').html('RMS Mapping Quality. This distribution represents all variants in iranome.');
                        else if (v[0] == 'Quality by Depth (QD)')
                            $('#site_quality_note').html('Variant Confidence/Quality by Depth. This distribution represents all variants in iranome.');
                        else if (v[0] == 'Read Depth (DP)')
                            $('#site_quality_note').html('Approximate read depth; some reads may have been filtered. This distribution represents all variants in iranome.');
                        else if (v[0] == 'ReadPosRankSum')
                            $('#site_quality_note').html('Z-score from Wilcoxon rank sum test of Alt vs. Ref read position bias. This distribution represents all variants in iranome.');
                        else
                            $('#site_quality_note').html('');
                    }
                    draw_quality_histogram(data, '#quality_metric_container', log);
                    add_line_to_quality_histogram(data, v[1], '#quality_metric_container', log);
                });
            } else {
                $('#quality_metrics_container').hide();

            }
        });
    </script>

    <div class="container">
        <h1><span class="hidden-xs">Variant: </span>
LABEL;
echo"$variant";
echo <<<LABEL
        </h1>
        <hr/>
        
            <div class="row">
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Genome build</dt>
                        <dd> GRCh37/hg19</dd>
                        <dt>Variant Type</dt>
                        <dd> 
LABEL;
echo"$anno";

echo                        "</dd>";
echo                        "<dt>AF in GnomAD</dt>";
echo                        "<dd> ".$gnomad."</dd>";
echo                        "<dt>Allele Count</dt>";
echo                        "<dd> ".$AC."/".$AN."</dd>";
echo                        "<dt>Gene</dt>";
echo                        "<dd> ".'<a href="gene.php?query='.$gene.'">'.$gene.'</a>'." in database</dd>";
echo <<<LABEL
                        <dt>Consequence</dt>
                    <dd>
                        <div class="dropdown">
                            <button data-toggle="dropdown" class="btn btn-inverse btn-xs dropdown-toggle">
                                cDNA and AA change
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-inverse" role="menu" aria-labelledby="external_ref_dropdown">
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" target="_blank">
                                        cDNA change: 
LABEL;
echo"$cDNA";
echo <<<LABEL
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a role="menuitem" tabindex="-1" target="_blank">
                                        AA change: 
LABEL;
echo"$aa";
echo <<<LABEL
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </dd>

                        <dt>- - - - - - - - </dt>
                        <dd>- - - - - - - -</dd>
LABEL;
echo                        "<dt>LitVar</dt>";
echo                        "<dd> ".'<a href="https://www.ncbi.nlm.nih.gov/research/litvar2/docsum?variant=litvar@'.$rs_dbSNP.'%23%23">'.$rs_dbSNP.' <i class="fa fa-external-link"></i>'."</a></dd>";
echo                        "<dt>dbSNP</dt>";
echo                        "<dd> ".'<a href="http://www.ncbi.nlm.nih.gov/projects/SNP/snp_ref.cgi?rs='.$rs_dbSNP.'">'.$rs_dbSNP.' <i class="fa fa-external-link"></i>'."</a></dd>";

echo                        "<dt>UCSC</dt>";
echo                        "<dd> ";
echo                            '<a href="https://genome.ucsc.edu/cgi-bin/hgTracks?db=hg19&lastVirtModeType=default&lastVirtModeExtraState=&virtModeType=default&virtMode=0&nonVirtPosition=&position=chr'.$chr.'%3A'.$pos.'-'.$pos.'">'.$variant.' <i class="fa fa-external-link"></i></a>';
echo                        "</dd>";

echo                        "<dt>ClinVar</dt>";
echo                        "<dd> ";
echo                            '<a href="http://www.ncbi.nlm.nih.gov/clinvar?term='.$rs_dbSNP.'" target="_blank">'.$variant.' in Clinvar <i class="fa fa-external-link"></i></a>';
echo                        "</dd>";

echo   			    "<dt>NHLBI ESP</dt>";
echo                        "<dd> ";
echo                            '<a href="http://evs.gs.washington.edu/EVS/PopStatsServlet?searchBy=chromosome&chromosome='.$chr.'&chromoStart='.$pos.'&chromoEnd='.$pos.'&x=0&y=0" target="_blank">'.$variant.' in NHLBI ESP <i class="fa fa-external-link"></i></a>';
echo                        "</dd>";
			
echo                        "<dt>Ensembl</dt>";
echo                        "<dd> ";
echo			        '<a href="http://grch37.ensembl.org/Homo_sapiens/Variation/Explore?db=core;v='.$rs_dbSNP.'" target="_blank">'.$rs_dbSNP.' in Ensembl <i class="fa fa-external-link"></i></a>';  
echo                        "</dd>";
			
echo			"<dt>gnomAD Browser</dt>";
echo			"<dd> ";
echo			    '<a href="http://gnomad.broadinstitute.org/variant/'.$chr.'-'.$pos.'-'.$ref.'-'.$alt.'?dataset=gnomad_r2_1" target="_blank">'.$variant.' in gnomAD Browser <i class="fa fa-external-link"></i></a>';
echo                    "</dd>";

echo                    "<dt>All of Us</dt>";
echo                    "<dd> ";
echo                        '<a href="https://databrowser.researchallofus.org/variants/'.$rs_dbSNP.'" target="_blank">'.$rs_dbSNP.' in All of Us <i class="fa fa-external-link"></i></a>';
echo                    "</dd>";
echo <<<LABEL
                    </dl>
                </div>
                <div class="col-md-6">
                
                <div class="section_header" style="margin-left: -15px;">Effect Predictors</div>
                <table id="annotate_table" class="tablesorter tablesorter-default" role="grid">
        	                <thead> <tr> <th>Metric</th> <th>Prediction</th></tr></thead>
        	                <tbody>
        	                    
        	                        <tr>
        	                            <td>SIFT Pred</td>
LABEL;

echo        	                            "<td>".$SIFT."</td>";
echo        	                        "</tr>";
        	                    
echo        	                        "<tr>";
echo        	                            "<td>Polyphen2 HVAR Pred</td>";
echo        	                            "<td>".$Polyphen."</td>";
echo        	                        "</tr>";
        	                    
echo        	                        "<tr>";
echo        	                           "<td>REVEL score</td>";
echo        	                            "<td>".$REVEL."</td>";
echo        	                        "</tr>";

echo        	                        "<tr>";
echo        	                            "<td>CADD Score (Phred Scale)</td>";
echo        	                            "<td>".$CADD."</td>";
echo        	                        "</tr>";
        	                    
echo        	                        "<tr>";
echo        	                            "<td>ClinPred Score</td>";
echo        	                            "<td>".$ClinPred."</td>";
echo        	                        "</tr>";
        	                    
echo        	                        "<tr>";
echo        	                            "<td>MutPred Score</td>";
echo        	                            "<td>".$MutPred."</td>";
echo        	                        "</tr>";

echo                                    "<tr>";
echo                                        "<td>VEST4 Score</td>";
echo                                        "<td>".$VEST."</td>";
echo                                    "</tr>";

echo                                    "<tr>";
echo                                        "<td>MutScore</td>";
echo                                        "<td>".$Mutscore."</td>";
echo                                    "</tr>";

echo                                    "<tr>";
echo                                        "<td data-tooltip='DP_AG|DP_AL|DP_DG|DP_DL|DS_AG|DS_AL|DS_DG|DS_DL'>SpliceAI Score</td>";
echo                                        "<td>".$spliceAI."</td>";
echo                                    "</tr>";
echo <<<LABEL

        	                </tbody>
        	                <tfoot> </tfoot>
        	            </table>


                </div>
            </div>
            <hr/>
        



		<div class="row">

			<div id="frequency_info_container">
                <div class="section_header">Population Frequencies</div>
                <div id="frequency_table_container" class="frequency_displays">
                    
                    <table id="frequency_table">
                        <thead>
                            <tr>
                                <th data-tooltip="Name of the cohort">Cohort ID</th>
                                <th data-tooltip="Counts of each alternate allele for each site across all samples">Allele Count</th>
                                <th data-tooltip="Total number of observed alleles in called genotypes">Allele Number</th>
                                <th data-tooltip="Number of homozygous or hemizygous non-reference genotypes across all samples">Number of Homozygotes or Hemizygous</th>
				<th data-tooltip="Number of heterozygous genotypes across all samples">Number of Heterozygotes</th>
                                <th data-tooltip="Frequencies of each allele for each site across all samples">Allele Frequency</th>
                            </tr>
                        </thead>
                        <tbody>
LABEL;
                         
echo                                "<tr>";
echo                                    "<td>";
echo                                       '<a href="genotype.php?variant='.$variant.'&cohort=Chen_lab">Chen_lab</a>';
echo                                    "</td>";                                    
echo                                    "<td>".$Chen_lab_AC."</td>";
echo                                    "<td>".$Chen_lab_AN."</td>";
echo                                    "<td>".$Chen_lab_hom."</td>";
echo                                    "<td>".$Chen_lab_het."</td>";
echo                                    "<td>".$Chen_lab_AF."</td>";                                 
echo                                "</tr>";
echo                                "<tr>";
echo                                    "<td>";
echo                                       '<a href="genotype.php?variant='.$variant.'&cohort=NEI_eyeGENE">NEI_eyeGENE</a>';
echo                                    "</td>";                                    
echo                                    "<td>".$NEI_eyeGENE_AC."</td>";
echo                                    "<td>".$NEI_eyeGENE_AN."</td>";
echo                                    "<td>".$NEI_eyeGENE_hom."</td>";
echo                                    "<td>".$NEI_eyeGENE_het."</td>";
echo                                    "<td>".$NEI_eyeGENE_AF."</td>";                                 
echo                                "</tr>";
echo                        "<tfoot>";
echo                                "<tr>";
                                
echo                                "<td><b>Total</b></td>";
echo                                "<td><b>".$AC."</b></td>";
echo                                "<td><b>".$AN."</b></td>";
echo                                "<td><b>".$hom."</b></td>";
echo                                "<td><b>".$het."</b></td>";
echo                                "<td><b>".$AF."</b></td>";
echo <<<LABEL
                  
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>

		</div>
    </div>

</body>

LABEL;
}
?>
