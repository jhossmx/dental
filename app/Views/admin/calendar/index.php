<?php $this->extend('layout/admin') ?>
<?php $session = \Config\Services::session(); ?>

<?php $this->section('css') ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<?php echo $this->include('layout/adm/infoUser'); ?>

<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="icon-docs icons"></i> Calendario de Citas</h4>
                <div class="row">
                    <div id="calendar" class="p-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->include('admin/calendar/modal'); ?>
<?php $this->endSection() ?>

<?php $this->section('js') ?>


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale/es.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        let calendar = $('#calendar').fullCalendar({
            editable: true,
            firstDay: 1,
            defaultView: 'month',
            height: 650,
            contentHeight: "auto",
            expandRows: true,
            timeFormat: 'H:mm',
            slotLabelFormat: "H:mm",
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            views: {
                agendaWeek: {
                    columnFormat: "ddd D/M"
                }
            },
            events: base_url + 'admin/loadDataCalendar',
            selectable: true,
            selectHelper: true,
            locales: 'es',

            // $('#save_events').click(function(){
            select: function(start, end) {
                var view = calendar.fullCalendar('getView')
                if (view.name == "month" || view.name == "agendaWeek") {
                    $('#cal_modal').modal('show');
                    var setstart = $.fullCalendar.formatDate(start, "Y-MM-DD");
                    var setend = $.fullCalendar.formatDate(end, "Y-MM-DD");
                    var setfrom = $.fullCalendar.formatDate(start, "HH:mm:ss");
                    var setto = $.fullCalendar.formatDate(end, "HH:mm:ss");
                    $('#datefrom').val(setstart);
                    $('#dateto').val(setend);
                    $('#timefrom').val(setfrom);
                    $('#timeto').val(setto);

                } else if (view.name == "agendaDay") {
                    $('#day_modal').modal('show');
                    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                    $('#daystart').val(start)
                    $('#dayend').val(end)
                }
            },
            eventResize: function(event) {
                if (event.status == 1) {
                    event.draggable = false;
                } else {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: base_url + 'admin/updateDataCalendar',
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            Swal.fire({
                                icon: 'success',
                                title: 'Event Updated',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    })
                }
            },
            eventDrop: function(event) {

                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //alert(start);
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //alert(end);
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:  base_url + 'admin/updateDataCalendar',
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function(data) {
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Updated',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                })
            },
            eventClick: function(event) {
                var id = event.id;
                $.ajax({
                    "url": base_url + 'admin/getCalendarData',
                    "data": {
                        id: id
                    },
                    "type": "POST",
                    dataType: "json",
                    success: function(data) {
                        $('#up_titles').val(data.fw_title);
                        $('#up_datefrom').val(data.fw_start_date);
                        $('#up_dateto').val(data.fw_end_date);
                        $('#up_timefrom').val(data.fw_start_time);
                        $('#up_timeto').val(data.fw_end_time);
                        $('#up_id').val(data.fw_id);
                        $('#update_cal_modal').modal('show');
                        $('#up_time_error').text(null);
                        $('#time_error').text(null);
                    },
                    error: function() {

                    }
                });
            }
        });

        $('#save_events_day').click(function() {

            $('#day_modal').modal('show');
            // var a=prompt('a');
            if ($('#center_name_day').val() == "") {
                $('#dis_error_day').text('Note : All Field Required');
                return false;
            } else {
                $('#dis_error_day').text(null);
                $('#day_modal').modal('hide');
                var center = $('#center_name_day').val();
                var start = $('#daystart').val();
                var end = $('#dayend').val();
                $.ajax({
                    url:  base_url + 'admin/insertDataDay',
                    type: "POST",
                    data: {
                        title: center,
                        start: start,
                        end: end
                    },
                    success: function() {
                        $('#day_form')[0].reset()
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Added Successfully',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                })
            }
        });

        //save events by month and by week          
        $('#save_events').click(function() {

            if ($('#datefrom').val() == "" || $('#dateto').val() == "" || $('#center_name').val() == "" || $('#timeto').val() == "" || $('#timefrom').val() == "") {
                $('#dis_error').text('Note : All Field Required');
                return false;
            } else {
                $('#dis_error').text(null);
                $('#cal_modal').modal('hide');
                $.ajax({
                    url:   base_url + 'admin/insertDataCalendar',
                    type: "POST",
                    data: $('#suspend_form').serialize(),
                    success: function() {
                        $('#suspend_form')[0].reset();
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Added Successfully',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                });
            }
        });

        $('#up_save_events').click(function() {

            if ($('#up_datefrom').val() == "" || $('#up_dateto').val() == "" || $('#up_center_name').val() == "" || $('#up_timeto').val() == "" || $('#up_timefrom').val() == "") {
                $('#up_dis_error').text('Note : All Field Required');
                return false;
            } else {
                $('#up_dis_error').text(null);
                $('#update_cal_modal').modal('hide');

                $.ajax({
                    url:  base_url + 'admin/upInsertDataCalendar',
                    type: "POST",
                    data: $('#up_suspend_form').serialize(),
                    success: function() {
                        $('#up_suspend_form')[0].reset()
                        calendar.fullCalendar('refetchEvents');
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Updated Successfully',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                });
            }
        });

        $('#del').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.value) {
                    var id = $('#up_id').val();
                    $.ajax({
                        url:  base_url +'admin/deleteDataCalendar',
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function() {
                            $('#update_cal_modal').modal('hide');
                            calendar.fullCalendar('refetchEvents');
                            Swal.fire({
                                icon: 'success',
                                title: 'Event Removed',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        }
                    })
                }
            });
        });
    });
</script>

<?php $this->endSection() ?>