<?php
$this->pageTitle = $_GET['title'];
$this->breadcrumbs = array(
    $_GET['title']
);
?>
<h2>Event</h2>
<hr>
<?php
$this->widget('common.extensions.landa.widgets.LandaCalender');
?>

<script>

    $(document).ready(function() {
        $('#calendar').fullCalendar({
            events: [
              
                <?php
                $b="";
                foreach ($model as $a) {
                    $title = $a->title;
                    $created = date('F d,Y,', strtotime($a->date_event));
                    $url = url('event/' . $a->alias);
                    $b.='{
                    title: "'.$title.'",
                    start: new Date("'.$created.'"),
                    allDay: false,
                    url: "'.$url.'"
                },';
                }
                echo $b;
                ?>
                                

            ]
        });

    });

</script>
