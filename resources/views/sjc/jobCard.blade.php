@extends('layouts.master')

@section('title')
    Job Card
@endsection


@section('content')
    @include('includes.message-block')
    <h3>Job Card for Ticket# {{ $ticketId }}</h3>
    <form action="{{ route('sjc.email') }}" method="POST">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> <!-- Accordion -->
        <div class="panel panel-default">   <!-- Faults & Warnings Panel-->
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none">
                        Faults & Warnings <span class="caret"></span>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Ink Low"> INK LOW
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Makeup Ink Low"> MAKEUP INK LOW
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Ink Drop Charge Too Low"> INK DROP CHARGE TOO LOW
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Deflection Voltage Leakage"> DEFLECTION VOLTAGE LEAKAGE
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Ink Shelf Life Exceeded"> INK SHELF LIFE EXCEEDED
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Battery Low"> BATTERY LOW
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Cooling Fan Fault"> COOLING FAN FAULT
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="High Ink Concentration"> HIGH INK CONCENTRATION
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Main Ink Tank Too Full"> MAIN INK TANK TOO FULL
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Replenishment Timeout"> REPLENISHMENT TIMEOUT
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="No Ink Drop Charge"> NO INK DROP CHARGE
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Ink Drop Charge Too High"> INK DROP CHARGE TOO HIGH
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Print Overlap Fault"> PRINT OVERLAP FAULT
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Cover Open"> COVER OPEN
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Pump Motor Fault"> PUMP MOTOR FAULT
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="fnw[]" value="Low Ink Concentration"> LOW INK CONCENTRATION
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <textarea name="otherFault" id="otherFault" style="width: 100%;
                                                                           -webkit-box-sizing: border-box;
                                                                           -moz-box-sizing: border-box;
                                                                           box-sizing: border-box;" rows="10"
                                                                           placeholder="Other Faults...">{{ Request::old('otherFault') }}</textarea>
                    </div>
                </div>
            </div>
        </div> <!-- Faults & Warnings Panel-->
        <div class="panel panel-default"> <!-- Actions Panel-->
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration: none">
                        Actions <span class="caret"></span>
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="col-md-4"> <!-- Actions Panel Col 1-->
                        <h5>Action Taken:</h5>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Clean Printhead"> CLEAN PRINTHEAD
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Back Wash Nozzle and Cutter"> BACK WASH NOZZLE AND CUTTER
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Align Nozzle"> ALIGN NOZZLE
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Drain Ink"> DRAIN INK
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Refill Ink"> REFILL INK
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Refill Make Up"> REFILL MAKE UP
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Calibrate Viscometer"> CALIBRATE VISCOMETER
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Adjust Ink Pressure"> ADJUST INK PRESSURE
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Solenoid Valve Testing"> SOLENOID VALVE TESTING
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Adjust Excitation"> ADJUST EXCITATION
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Nozzle Test"> NOZZLE TEST
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Machine Reset"> MACHINE RESET
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="actTaken[]" value="Pull-out Machine"> PULL-OUT MACHINE
                            </label>
                        </div>

                    </div> <!-- Actions Panel Col 1-->
                    <div class="col-md-4"> <!-- Actions Panel Col 2-->
                        <h5>Replaced Parts:</h5>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Main Ink Filter"> MAIN INK FILTER
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Circulation Filter PTFE"> CIRCULATION FILTER (P.T.F.E)
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Make Up Ink Filter PTFE"> MAKE UP INK FILTER (P.T.F.E)
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="MGV9 Filter"> MGV9 FILTER
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Capsule Filter"> CAPSULE FILTER
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Solenoid Filter"> SOLENOID FILTER
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Pump Motor"> PUMP MOTOR
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Cooling Fan"> COOLING FAN
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Gutter Assy"> GUTTER ASSY
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Back-up Battery"> BACK-UP BATTERY
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Replaced Main Ink Tank"> REPLACED MAIN INK TANK
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Subtank"> SUBTANK
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="repPart[]" value="Cover Switch"> COVER SWITCH
                            </label>
                        </div>


                    </div> <!-- Actions Panel Col 2-->
                    <div class="col-md-4"> <!-- Actions Panel Col 3-->
                        <textarea name="otherAction" id="otherAction" style="width: 100%;
                                                                           -webkit-box-sizing: border-box;
                                                                           -moz-box-sizing: border-box;
                                                                           box-sizing: border-box;" rows="20"
                                  placeholder="Others...">{{ Request::old('otherAction') }}</textarea>
                    </div> <!-- Actions Panel Col 3-->
                </div>
            </div>
        </div> <!-- Actions Panel-->
        <div class="panel panel-default"> <!-- Footer Panel -->
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="text-decoration: none">
                        Nature of Call <span class="caret"></span>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <div class="col-md-4"> <!-- Footer Panel Col 1 -->
                        <h5>Action Taken:</h5>
                        <div class="radio">
                            <label>
                                <input type="radio" name="noc" value="Demo"> DEMO
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="noc" value="Installation"> INSTALLATION
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="noc" value="Service Charge"> SERVICE CHARGE
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="noc" value="Warranty Check-up"> WARRANTY CHECK-UP
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="noc" value="Under AMC"> UNDER AMC
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="noc" value="FOC"> F.O.C
                            </label>
                        </div>
                    </div> <!-- Footer Panel Col 1 -->
                    <div class="col-md-4"> <!-- Footer Panel Col 2 -->
                        <textarea name="remarks" id="remarks" style="width: 100%;
                                                                           -webkit-box-sizing: border-box;
                                                                           -moz-box-sizing: border-box;
                                                                           box-sizing: border-box;" rows="10"
                                  placeholder="Remarks...">{{ Request::old('remarks') }}</textarea>
                    </div> <!-- Footer Panel Col 2 -->
                </div>
            </div>
        </div> <!-- Footer Panel -->
    </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <label for="fae">Field Service Engineer Name:</label>
                    <input type="text" name="fae" class="form-control" value="{{ Request::old('fae') }}">
                    <label for="customerSupervisor">Customer Supervisor:</label>
                    <input type="text" class="form-control" name="customerSupervisor" value="{{ Request::old('customerSupervisor') }}">
                </div>
                <div class="col-md-6">
                    <label for="jobDate">Job Date:</label>
                    <input type="date" name="jobDate" id="jobDate" class="form-control" value="{{ Request::old('jobDate') }}" disabled>
                    <label for="machineHours">Machine Hours:</label>
                    <input type="text" class="form-control" name="machineHours" value="{{ Request::old('machineHours') }}">
                </div>
            </div>
            <div class="text-center">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input type="hidden" name="ticketId" value="{{ $ticketId }}">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>

    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            //set todays date
            let date = new Date();
            let day = date.getDate();
            let month = date.getMonth()+1;
            let year = date.getFullYear();

            if (month < 10) month = '0' + month;
            if (day < 10) day = '0' + day;
            let today = year+'-'+month+'-'+day;
            $('#jobDate').val(today);
        });
    </script>
@endsection