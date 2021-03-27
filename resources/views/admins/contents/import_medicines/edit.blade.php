@extends('admins.layouts.master')
@section('css')
    <!-- FILE UPLOADE CSS -->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!-- SELECT2 CSS -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <form action="{{route('admin.import_medicine.postEdit',$import->id)}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="col-6 p-0">
                                <h3 class="mb-0 card-title">Chỉnh sửa đơn nhập</h3>
                            </div>
                            <div class="col-6 p-0">
                                <div class="btn-list text-right">
                                    <button type="button" class="btn btn-outline-default" data-toggle="tooltip"
                                            title="Quay về trang danh sách thuốc">
                                        <a href="{{route('admin.medicine.getIndex')}}" style="color: inherit;"><i
                                                class="icon icon-action-undo mr-2"></i>Quay lại</a>
                                    </button>
                                    <button type="submit" class="btn btn-primary"
                                            id="add_continue"><i
                                            class="ti-save-alt mr-2"></i>Lưu
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <table id="import_datatable" class="table card-table table-vcenter text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Số lượng</th>
                                        <th>Số lượng</th>
                                        <th>Ghi chú</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($medicines as $k=>$medicine)
                                        <tr>
                                            <th>{{$k+1}}<input type="number" name="medicine_id[]"
                                                               value="{{$medicine->id}}" hidden></th>
                                            <th>{{$medicine->name}}</th>
                                            <th>
                                                <input type="number" class="form-control"
                                                       name="import_medicine[{{$k}}][amount]"
                                                       value={{$medicine->pivot->amount}} >
                                            </th>
                                            <th>
                                                <select name="import_medicine[{{$k}}][unit]"
                                                        class="form-control select2 custom-select"
                                                        data-placeholder="Chọn đơn vị tính">
                                                    <option label="Chọn đơn vị tính">
                                                    </option>
                                                    @if(count($units = $medicine->units)>0)
                                                        @foreach($units as $unit)
                                                            <option
                                                                {{$unit->id == $medicine->pivot->unit ? "selected":""}} value="{{$unit->id}}">{{$unit->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </th>
                                            <th>
                                                <textarea class="form-control" name="import_medicine[{{$k}}][note]"
                                                          rows="1">{{$medicine->pivot->note}}</textarea>
                                            </th>
                                            <th>
                                                <div class="btn-list">
                                                    <button type="button" class="btn btn-icon  btn-red"
                                                            data-toggle="tooltip"
                                                            data-title="Xóa"><i class="ti-close"></i></button>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" name="save_continue" hidden></button>
                            <button type="submit" name="save_close" hidden></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->

@endsection

@section('js')
    <!-- FORMELEMENTS JS -->
    <script src="{{ URL::asset('assets/js/form-elements.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/time-picker/toggles.min.js') }}"></script>
@endsection
