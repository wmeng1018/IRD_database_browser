<?php

$variant = $_GET['variant'];
$cohort = $_GET['cohort'];
$mysqli = mysqli_connect("host", "user", "pass", "db", "3306") or die ("Connection Error");
$test = $mysqli->query("select p.id, p.gender,p.age,p.ethnic, p.phenotype, p.medicalInfo, p.familyInfo,pv.genotype, pv.seqType, pv.comment from probands as p inner join proband_variant as pv on p.id=pv.probandID where pv.variantID='$variant' and p.cohortID='$cohort' ");

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
        release_number = 1.0;
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
                        <input id="navbar-searchbox-input" name="query" class="form-control awesomebar" type="text" placeholder="Search for a variant"/>
                        <input type="submit" style="position: absolute; left: -9999px"/>
                    </div>
                </form>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
    </div><!-- /.container-fluid -->
</nav>

    <style>
    .table td, .table th {
        font-size: 14px;
    }
    </style>
    <div class="container">
        <br><br>
        <center>
	<h2>Medical and genotype information for probands in 
LABEL;
echo "$cohort";
echo <<<LABEL
 with 
LABEL;
echo'<a href="variant.php?query='.$variant.'">'.$variant.'</a>';
echo <<<LABEL
	</h2>
        <hr/>
        </center>
  
									<div class="col-xs-12">
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>

										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="hidden-xs tooltip-table-header" data-tooltip="Proband ID">Proband ID</th>
														<th class="hidden-xs tooltip-table-header" data-tooltip="Genotype">Genotype<span class="caret"></span></th>
														<th class="hidden-xs tooltip-table-header" data-tooltip="Data source: Capture or WES or WGS">Source<span class="caret"></span></th>
														<th class="hidden-xs tooltip-table-header" data-tooltip="">Gender<span class="caret"></span></th>
														<th class="hidden-xs tooltip-table-header" data-tooltip="">Age<span class="caret"></span></th>
                                                                                                                <th class="hidden-xs tooltip-table-header" data-tooltip="">Ethnicity<span class="caret"></span></th>
														<th class="hidden-xs tooltip-table-header" data-tooltip="Eye disease">Phenotype<span class="caret"></span></th>
														<th class="hidden-xs tooltip-table-header" data-tooltip="">Medical Information<span class="caret"></span></th>
														<th class="hidden-xs tooltip-table-header" data-tooltip="">Family Information<span class="caret"></span></th>
                                                                                                                <th class="hidden-xs tooltip-table-header" data-tooltip="Other comments">Comments<span class="caret"></span></th>
														
														
													</tr>
												</thead>

												<tbody>
												
LABEL;
					while ($testing=$test->fetch_assoc()) {
                                            $ID = $testing["id"];
                                            $genotype = $testing["genotype"];
					    $seqType = $testing["seqType"];
					    $gender = $testing["gender"];
					    $age = $testing["age"];
					    $ethnic = $testing["ethnic"];
					    $phenotype = $testing["phenotype"];
					    $medicalInfo = $testing["medicalInfo"];
					    $familyInfo = $testing["familyInfo"];
					    $comment = $testing["comment"];


      			        echo "<tr>";
                                echo "<td class='hidden-xs'>".'<a href="proband.php?query='.$ID.'">'.$ID."</td>";
                                echo "<td class='hidden-xs'>".$genotype."</td>";
				echo "<td class='hidden-xs'>".$seqType."</td>";
				echo "<td class='hidden-xs'>".$gender."</td>";
				echo "<td class='hidden-xs'>".$age."</td>";
	                        echo "<td class='hidden-xs'>".$ethnic."</td>";
	                        echo "<td class='hidden-xs'>".$phenotype."</td>";
	                        echo "<td class='hidden-xs'>".$medicalInfo."</td>";
	                        echo "<td class='hidden-xs'>".$familyInfo."</td>";
	                        echo "<td class='hidden-xs'>".$comment."</td>";			
      		        	echo "</tr>";
      		         }

echo <<<LABEL
                              
												</tbody>
											</table>
										</div>
									</div>
								</div>

<script src="static/js/jquery-2.1.4.min.js"></script>
		<script src="static/js/bootstrap.min.js"></script>
		<script src="static/js/jquery.dataTables.min.js"></script>
		<script src="static/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="static/js/dataTables.buttons.min.js"></script>
		<script src="static/js/buttons.flash.min.js"></script>
		<script src="static/js/buttons.html5.min.js"></script>
		<script src="static/js/buttons.print.min.js"></script>
		<script src="static/js/buttons.colVis.min.js"></script>
		<script src="static/js/dataTables.select.min.js"></script>
		<script src="static/js/ace-elements.min.js"></script>
		<script src="static/js/ace.min.js"></script>
		
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": true },
					  null,null,null,null,null,null,null,null, 
					  { "bSortable": true }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#dynamic-table  > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				

			
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				//selectmenu
				 $( "#valid" ).css('width', '200px')
				.selectmenu({ position: { my : "left bottom", at: "left top" } })

				
			
			})
		</script>
</body>


LABEL;
?>
