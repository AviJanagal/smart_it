@include('employee.layouts.header')
@include('employee.layouts.sidebar')

<main class="maintop">
    <div class="mainsectionbox">
        <div class="container-fluid">
            @if(Session::get('alert'))
            <div class="alert alert-{{Session::get('alert')}} alert-dismissible" role="alert">
                <p>{{Session::get('message')}} </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            @endif
            @include('sweet::alert')
        </div>
    <div class="bank-innersection">
        <div class="table-title-add">
            <div class="row">
            <div class="col-sm-12">
            <h2 style="text-align:center;">My Productivity Graph</h2>
            </div>
            </div>
        </div>
        <form method="post" action="{{ route('employee.graph_time')}}" id="filterForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-2">       
                    <select class="form-select" aria-label="Default select example" name="graph_time" id="graph_time" onchange="this.form.submit()" required>
                        <option  disabled value="">Select Time Period</option>
                        <option value="weekly" {{($type == "weekly" ? "selected":"")}}>Weekly</option>
                        <option value="monthly" {{($type == "monthly" ? "selected":"")}}>Monthly</option>
                        <option value="yearly" {{($type == "yearly" ? "selected":"")}}>Yearly</option>
                    </select>
                </div>
            </div> 
        </form>

        </div>
        <div class=" chartcustom">
        <div class="main-container-inner">
            <div class="col-sm-12 mb-4 mt-4">
            <div id="columnchart_values"></div>
        </div>
        </div>
        </div>

    </div> 
</main>

@include('employee.layouts.footer')

<script>
    $('#submit').on('click', function() {
        var value = $("#graph_time").val();
    });
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    	
    var my_array = <?php echo json_encode($result, JSON_NUMERIC_CHECK);?>;
        // console.log(my_array);

    var title = [
        ['Date','Hours', { role: "style" } ]
    ];

    var complaints = jQuery.merge(title, my_array);

    var data = google.visualization.arrayToDataTable(complaints);

    
    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        { calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation" },
        2]);
      var options = {
        height:550,
        width: "100%",
    	title: "<?php echo $title_discription; ?>",
    	bar: {groupWidth: "95%"},
         hAxis: {
            title: "<?php echo $title; ?>",
        },
         vAxis: {
            title: 'Time Taken (Hours)',
            minValue: 0
        },
    	legend: { position: "none" },

      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
     }
</script>
