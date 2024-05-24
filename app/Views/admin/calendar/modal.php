<div class="modal" tabindex="-1" id="cal_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="dis_error" class="text-danger"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="suspend_form">
                    <div class="row">

                        <div class="col-md-12">
                            <label>Event</label>
                            <select class="form-control" id="event" name="title">
                                <option value="">Select event</option>
                                <option value="Google">Google</option>
                                <option value="Youtube">Youtube</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="mt-2">Date From<span class="text-warning">*</span></label>
                            <input type="date" class="form-control" id="datefrom" name="start">
                        </div>

                        <div class="col-md-12">
                            <label class="mt-2">Date To<span class="text-warning">*</span></label>
                            <input type="date" class="form-control" id="dateto" name="end">
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label class="mt-2">Time From<span class="text-warning">*</span></label>
                            <input type="time" class="form-control" id="timefrom" name="timestart">
                        </div>

                        <div class="col-md-6">
                            <label class="mt-2">Time To<span class="text-warning">*</span></label>
                            <input type="time" class="form-control" id="timeto" name="timeend">
                            <span id="time_error" class="text-danger"></span>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="save_events" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="update_cal_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" id="del">Delete</button>
                <h5 class="modal-title"><span id="up_dis_error" class="text-danger"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="up_suspend_form">
                    <div class="row">
                        <span>Note : <span class="text-warning">*</span> Denoted Field Are Required </span><br><br>
                        <div class="col-md-12">
                            <label>Event</label>
                            <select class="form-control" id="up_titles" name="up_title">
                                <option value="">Select event</option>

                                <option value="Google">Google</option>
                                <option value="Youtube">Youtube</option>

                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="mt-2">Date From<span class="text-warning">*</span></label>
                            <input type="date" class="form-control" id="up_datefrom" name="up_start" readonly>
                            <input type="hidden" class="form-control" id="up_id" name="up_id">
                        </div>

                        <div class="col-md-12">
                            <label class="mt-2">Date To<span class="text-warning">*</span></label>
                            <input type="date" class="form-control" id="up_dateto" name="up_end" readonly>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label class="mt-2">Time From<span class="text-warning">*</span></label>
                            <input type="time" class="form-control" id="up_timefrom" name="up_timestart">
                        </div>

                        <div class="col-md-6">
                            <label class="mt-2">Time To<span class="text-warning">*</span></label>
                            <input type="time" class="form-control" id="up_timeto" name="up_timeend">
                            <span id="up_time_error" class="text-danger"></span>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="up_save_events" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" tabindex="-1" id="day_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="dis_error_day" class="text-danger"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="day_form">
                    <div class="row">
                        <span>Note : <span class="text-warning">*</span> Denoted Field Are Required </span><br>
                        <div class="col-md-12">
                            <label>Event</label>
                            <select class="form-control" id="center_name_day">
                                <option value="">Select event</option>
                                <option value="Google">Google</option>
                                <option value="Youtube">Youtube</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="mt-3"> <span>Drag Your Event To Change Date & Time</span></label>

                        </div>
                        <input type="hidden" id="daystart" name="">
                        <input type="hidden" id="dayend" name="">


                    </div>


                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="save_events_day" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>