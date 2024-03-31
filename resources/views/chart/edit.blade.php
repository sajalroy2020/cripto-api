<form id="chartEditForm">
    <div class="modal-header">
        <h6 class="modal-title">Update Chart data</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
    </div>

    <input type="hidden" id="id" name="id">

    <div class="modal-body">
        <div class="form-group text-start">
            <label>Time</label>
            <input class="form-control" id="time" name="time" autocomplete="time" type="date">
        </div>
        <div class="form-group text-start">
            <label>Open</label>
            <input class="form-control" step="0.01" id="open" name="open" autocomplete="open" placeholder="000.00" type="text">
        </div>
        <div class="form-group text-start">
            <label>High</label>
            <input class="form-control" step="0.01" id="high" name="high" autocomplete="high" placeholder="000.00" type="text">
        </div>
        <div class="form-group text-start">
            <label>Low</label>
            <input class="form-control" step="0.01" id="low" name="low" autocomplete="low" placeholder="000.00" type="text">
        </div>
        <div class="form-group text-start">
            <label>Close</label>
            <input class="form-control" step="0.01" id="close" name="close" autocomplete="close" placeholder="000.00" type="text">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="submitEditForm" class="btn btn-primary">Update</button>
        <button class="btn ripple btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
    </div>
</form>
