<div>
    <div class="col-md-12 p-4 faixa-jogos">
        <h3 class="text-center text-bold">{{ trans('admin.transferenciaSaldo.wallet') }}   </h3>
    </div>
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header indica-card">
                <h3 class="card-title">{{ trans('admin.transferenciaSaldo.tranfer') }}   </h3>
            </div>
            <div class="card-body" style="margin-top: -35px !important;">
                <div x-data="{data: @entangle('user')}">
                    <form wire:submit.prevent="transferToClient()">
                        <div class="row mt-5">
                            <div class="col-sm-7">
                                <div class="card-header ganhos-card">
                                    <h6><b>{{ trans('admin.transferenciaSaldo.dados') }} </b></h6>
                                </div>
                                <div class="col-sm-12">
                                    <b>{{ trans('admin.transferenciaSaldo.name') }} </b> <span x-text="data.name"></span>
                                </div>
                                <div class="col-sm-12">
                                    <b>{{ trans('admin.transferenciaSaldo.email') }}  </b> <span x-text="data.email"></span>
                                </div>
                                <div class="col-sm-12">
                                    <b>{{ trans('admin.transferenciaSaldo.phone') }}   </b> <span x-text="data.phone"></span>
                                </div>
                                <div class="col-sm-12">
                                    <b>PIX: </b>
                                    <small>{{ trans('admin.transferenciaSaldo.alterar') }} </small>
                                </div>
                                <div class="col-sm-12">
                                    <input wire:model.defer="pixSaque" class='col-sm-10' type="text" style="margin-bottom: 15px;"/>
                                </div>
                            </div>
                            <div class="col-sm-5">

                                <div class="card-header ganhos-card">
                                <h6><b>{{ trans('admin.transferenciaSaldo.valueRetirar') }} </b></h6>
                                </div>
                                <small class="text-muted">{{ trans('admin.transferenciaSaldo.valueMin') }}

                                    <small class="text-muted"><p> {{ trans('admin.transferenciaSaldo.valueInserido') }} </p></small>
                                </small>

                                <div class="input-group">
                                    <input wire:model="valueTransfer" x-on:focus="formatInput()" type="text"
                                           class="search-query form-control" placeholder="{{ trans('admin.transferenciaSaldo.valueRet') }} "
                                           id="valueTransfer" inputmode="numeric" value="0,00" />
                                </div>
                            </div>
                            <div class="col-sm-12 mt-5">
                                <div class="input-group">

                                    <button wire:click="requestWithdraw" type="button" class="btn btn-info btn-block">
                                    {{ trans('admin.transferenciaSaldo.solicit') }}  <span class="fa fa-send"></span>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <script src="https://cdn.jsdelivr.net/npm/vanilla-masker@1.1.1/build/vanilla-masker.min.js"></script>

    <script type="text/javascript">
        function formatInput(){
            VMasker(document.getElementById("valueTransfer")).maskMoney();
        }
    </script>
@endpush
