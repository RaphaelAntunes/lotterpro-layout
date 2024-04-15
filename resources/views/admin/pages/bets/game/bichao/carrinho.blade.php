<!-- Modal -->
<div class="modal fade" id="jogos-carrinho" tabindex="-1" role="dialog" aria-labelledby="jogos-carrinhoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jogos-carrinhoLabel">{{ trans('admin.bichao.labelCarrinho') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2" style="background-color:#212425;">
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <h4 class="text-center">{{ trans('admin.falta.listaJogos') }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-4" id="chart-text">
                            @foreach ($chart as $key => $chart)
                                <div class="chart-item">
                                    <div class="chart-item-number">
                                        {{$key + 1}}
                                    </div>
                                    <div class="chart-item-description">
                                        <p><b>{{$chart['modality']}}:</b> {{$chart['game']}}</p>
                                        <p><b>{{ trans('admin.falta.premio') }}:</b> {{join('°, ', $chart['award_type'])}}°</p>
                                        <p><b>{{ trans('admin.falta.valorpremiacao') }}:</b> {{ $chart['premiacao']}}</span></p>
                                        <p><b>{{ trans('admin.falta.valor') }}:</b> R${{number_format($chart['value'], 2, ',', '.')}}</p>
                                        @if (isset($chart['teimosinha']) && $chart['teimosinha'] >= 1)
                                            <p><b>{{ trans('admin.falta.teimosinha') }}</b> {{$chart['teimosinha']}} {{$chart['teimosinha'] > 1 ? 'repetições' : 'repetição'}}</p>
                                        @endif
                                    </div>
                                    <div class="chart-item-button"><a class="chart-remove-item" href="#" url="{{url('/')}}/admin/bets/bichao/remove/chart/{{$key}}">X</a></div>
                                </div>
                            @endforeach
                            @if (sizeof($chart) == 0)
                                <p class="text-center">{{ trans('admin.falta.carrinhoVazio') }}</p>
                            @else
                                <div class="clear-chart-container">
                                    <button class="btn btn-danger" id="clear-all-chart" type="button">{{ trans('admin.falta.limpCarrinho') }}</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group text-center card-master">
                                <label for="selecionar-estado-bichao">{{ trans('admin.falta.selecEstado') }}</label>
                                <select class="form-control" id="selecionar-estado-bichao">
                                    <option selected value="none" disabled>{{ trans('admin.falta.selecEstado') }}</option>
                                    @foreach ($estados as $estado)
                                        @if ($estado->uf != 'FED' || ($estado->uf == 'FED' && (date('w') == 3 || date('w') == 6)))
                                            <option value="{{ $estado->id }}">{{ $estado->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row hide" id="estado-sorteio">
                        <div class="col estado-sorteio">
                            <p class="mb-1"><b>{{ trans('admin.falta.escSorteio') }}:</b></p>
                            <div id="horarios-resultados"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center mt-4 p-4">
                            <h5><b>Total: R$ <span id="total-carrinho-text">{{ number_format($totalCarrinho, 2, ',', ' ') }}</span></b></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center align-items-end mb-4">
                            <button class="btn btn-primary" id="cadastrar-jogos" type="button">{{ trans('admin.falta.cadastJogos') }}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <script language=javascript type="text/javascript">
                                now = new Date
                                document.write(now.toLocaleString())
                                document.write("- Horário de Brasília.")
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.falta.fechar') }}</button>
            </div>
        </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="jogos-realizados" tabindex="-1" role="dialog" aria-labelledby="jogos-realizadosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jogos-realizadosLabel">{{ trans('admin.falta.jogosCadast') }}!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{ trans('admin.falta.valor') }}</th>
                            <th scope="col">{{ trans('admin.falta.jogo') }}</th>
                            <th scope="col">{{ trans('admin.falta.modalidade') }}</th>
                            <th scope="col" style="min-width: 160px">{{ trans('admin.falta.bilhete') }}</th>
                        </tr>
                    </thead>
                    <tbody id="jogos-realizados-table">
                        
                    </tbody>
                  </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.falta.fechar') }}</button>
            </div>
        </div>
    </div>
  </div>

@push('styles')
    <style>
         .card-master {


background-color: #323637;
padding: 10px;
border-radius: 5px;
}
        #chart-text {
            display: flex;
            flex-direction: column;
            row-gap: 15px;
        }

        .chart-item {
            display: flex;
            overflow: hidden;
            background-color: #323637;
            border-radius: 5px;
        }

        .chart-item-number {
            display: flex;
            align-items: center;
            font-size: 32px;
            padding: 20px 40px;
            font-weight: bold;
        }

        .chart-item-description {
            flex: 1;
            padding: 20px 0;
        }

        .chart-item-description p {
            margin-bottom: 5px !important;
        }

        .chart-item-description p:last-of-type {
            margin-bottom: 0 !important;
        }

        .chart-item-button a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            padding: 0px 25px;
            font-size: 18px;
            font-weight: bold;
            background-color: rgba(237,56,44,.75);
            color: #fff;
        }

        .clear-chart-container {
            text-align: right;
        }
    </style>
@endpush
