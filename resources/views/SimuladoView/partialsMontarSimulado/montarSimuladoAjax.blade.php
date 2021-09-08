<script type="text/javascript" async="async">
    $(document).ready(function () {
        $('#tabela_dados1').DataTable({
            "order": [
                [2, "asc"]
            ],
            "columnDefs": [
                {"orderable": false, "targets": 3}
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });

        $('#tabela_dados2').DataTable({
            "order": [
                [2, "asc"]
            ],
            "columnDefs": [
                {"orderable": false, "targets": 3}
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });

        $('#tabela_dados3').DataTable({
            "order": [
                [2, "asc"]
            ],
            "columnDefs": [
                {"orderable": false, "targets": 3}
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });

        $('#tabela_dados4').DataTable({
            "order": [
                [2, "asc"]
            ],
            "columnDefs": [
                {"orderable": false, "targets": 3}
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
            }
        });
    });
    $('[rel="tooltip"]').tooltip();

    // ---- Toogle Button / Tabs -------------------------------------------------------------
    $(document).ready(function() {
        
        $('#montar-simulado-questoes-objetivas-tab').on('click', function() {
            $('#switch_qst_objetivas').show()
            $('#switch_qst_discursivas').hide()
            $('.hide_simulado_discursiva').hide()
        })

        $('#montar-simulado-questoes-discursivas-tab').on('click', function() {
            $('#switch_qst_objetivas').hide()
            $('#switch_qst_discursivas').show()
            $('.hide_simulado_discursiva').show()
        })

        $('#tipo_montagem_objetiva').on('change', function(){

            var isChecked = $('#tipo_montagem_objetiva').prop('checked')

            const route_add_qst_obj_auto = "{{route('add_qst_simulado')}}"
            const route_add_qst_obj_manual = "{{route('add_qst_simulado_obj')}}"

            if(isChecked) {
                $('#form_qst_objetivas').attr('action', route_add_qst_obj_auto)
                $('#container_montagem_manual').hide()
                $('#cabecalho_03').text('2º')
                $('#container_requisicao_montagem_manual').show()
                $('#container_requisicao_montagem_automatica').show()
                $('.remove_qst_obj_async').hide()
                $('.excluir_qst_obj_async').show()
                $('#select_qst_objetivas').text("Adicionar Questões")
                $('#btn_get_questoes_objetivas').val('Adicionar')
                $('#bool_simulado_montagem_automatica_objetiva').val(Number(isChecked))
            } else {
                $('#form_qst_objetivas').attr('action', route_add_qst_obj_manual)
                $('#container_montagem_manual').show()
                $('#cabecalho_03').text('3º')
                $('#container_requisicao_montagem_manual').show()
                $('#container_requisicao_montagem_automatica').hide()
                $('.remove_qst_obj_async').show()
                $('.excluir_qst_obj_async').hide()
                $('.btn_hide_on_ready').hide()
                $('#select_qst_objetivas').text("Listar Questões")
                $('#btn_get_questoes_objetivas').val('Listar')
                $('#bool_simulado_montagem_automatica_objetiva').val(Number(isChecked))
            }

        });

        $('#tipo_montagem_discursiva').on('change', function(){
            var isChecked = $('#tipo_montagem_discursiva').prop('checked')

            const route_add_qst_disc_auto = "{{route('add_qst_disc_simulado_auto')}}"
            const route_add_qst_disc_manual = "{{route('add_qst_disc_simulado_manual')}}"

            if(isChecked) {
                $('#form_qst_discursivas').attr('action', route_add_qst_disc_auto)
                $('#container_montagem_manual_disc').hide()
                $('#cabecalho_03_disc').text('2º')
                $('#container_requisicao_montagem_manual_disc').show()
                $('#container_requisicao_montagem_automatica_disc').show()
                $('.remove_qst_disc_async').hide()
                $('.excluir_qst_disc_async').show()
                $('#select_qst_discursivas').text("Adicionar Questões")
                $('#btn_get_questoes_discursivas').val('Adicionar')
                $('#bool_simulado_montagem_automatica_discursiva').val(Number(isChecked))
            } else {
                $('#form_qst_discursivas').attr('action', route_add_qst_disc_manual)
                $('#container_montagem_manual_disc').show()
                $('#cabecalho_03_disc').text('3º')
                $('#container_requisicao_montagem_manual_disc').show()
                $('#container_requisicao_montagem_automatica_disc').hide()
                $('.remove_qst_disc_async').show()
                $('.excluir_qst_disc_async').hide()
                $('.btn_hide_on_ready_disc').hide()
                $('#select_qst_discursivas').text("Listar Questões")
                $('#btn_get_questoes_discursivas').val('Listar')
                $('#bool_simulado_montagem_automatica_discursiva').val(Number(isChecked))
            }
            
        });

    });

    // ---- Load inicial --------------------------------------------------------------
    $(document).ready(function(){

        if($('#montar-simulado-questoes-objetivas-tab').attr('aria-selected')) {
            $('#switch_qst_objetivas').show()
            $('#switch_qst_discursivas').hide()
            $('.hide_simulado_discursiva').hide()
        } else {
            $('#switch_qst_objetivas').hide()
            $('#switch_qst_discursivas').show()
            $('.hide_simulado_discursiva').show()
        }

        // ----- Montagem Simulado Objetivo ----------
        const route_add_qst_obj_auto = "{{route('add_qst_simulado')}}"
        const route_add_qst_obj_manual = "{{route('add_qst_simulado_obj')}}"

        var bool_simulado_montagem_automatica_objetiva = $('#bool_simulado_montagem_automatica_objetiva').val()
        $('#tipo_montagem_objetiva').prop('checked', bool_simulado_montagem_automatica_objetiva)

        $('.btn_hide_on_ready').hide()

        if($('.questoes_externas_obj').length > 0) {
            $('#tabela_externa').show()
            $('#questoes_obj_externas_empty').hide()
        } else {
            $('#tabela_externa').hide()
            $('#questoes_obj_externas_empty').show()
        }

        if($('.questoes_simulado_obj').length > 0) {
            $('#tabela_simulado').show()                
            $('#questoes_obj_simulado_empty').hide()
        } else {
            $('#tabela_simulado').show()
            $('#questoes_obj_simulado_empty').hide()
        }

        // Switch Montagem Objetiva
        if($('#tipo_montagem_objetiva').prop('checked')) {
            $('#form_qst_objetivas').attr('action', route_add_qst_obj_auto)
            $('#tipo_montagem_objetiva').bootstrapToggle('on')
            $('#container_montagem_manual').hide()
            $('#cabecalho_03').text('2º')
            $('#container_requisicao_montagem_manual').show()
            $('#container_requisicao_montagem_automatica').show()
            $('#select_qst_objetivas').text("Adicionar Questões")
            $('#btn_get_questoes_objetivas').val('Adicionar')
        } else {
            $('#form_qst_objetivas').attr('action', route_add_qst_obj_manual)
            $('#tipo_montagem_objetiva').bootstrapToggle('off')
            $('#container_montagem_manual').show()
            $('#cabecalho_03').text('3º')
            $('.btn_hide_on_ready').hide()
            $('#container_requisicao_montagem_manual').show()
            $('#container_requisicao_montagem_automatica').hide()
            $('#select_qst_objetivas').text("Listar Questões")
            $('#btn_get_questoes_objetivas').val('Listar')
        }

        // ----- Montagem Simulado Dicursivo ----------

        const route_add_qst_disc_auto = "{{route('add_qst_disc_simulado_auto')}}"
        const route_add_qst_disc_manual = "{{route('add_qst_disc_simulado_manual')}}"

        var bool_simulado_montagem_automatica_discursiva = $('#bool_simulado_montagem_automatica_discursiva').val()
        $('#tipo_montagem_discursiva').prop('checked', bool_simulado_montagem_automatica_discursiva)

        $('.btn_hide_on_ready_disc').hide()

        if($('.questoes_externas_disc').length > 0) {
            $('#tabela_externa_disc').show()
            $('#questoes_disc_externas_empty').hide()
        } else {
            $('#tabela_externa_disc').hide()
            $('#questoes_disc_externas_empty').show()
        }

        if($('.questoes_simulado_disc').length > 0) {
            $('#tabela_simulado_disc').show()                
            $('#questoes_disc_simulado_empty').hide()
        } else {
            $('#tabela_simulado_disc').show()
            $('#questoes_disc_simulado_empty').hide()
        }

        // Switch Montagem Discursiva
        if($('#tipo_montagem_discursiva').prop('checked')) {
            $('#form_qst_discursivas').attr('action', route_add_qst_disc_auto)
            $('#tipo_montagem_discursiva').bootstrapToggle('on')
            $('#container_montagem_manual_disc').hide()
            $('#cabecalho_03_disc').text('2º')
            $('#container_requisicao_montagem_manual_disc').show()
            $('#container_requisicao_montagem_automatica_disc').show()
            $('#select_qst_discursivas').text("Adicionar Questões")
            $('#btn_get_questoes_discursivas').val('Adicionar')
        } else {
            $('#form_qst_discursivas').attr('action', route_add_qst_disc_manual)
            $('#tipo_montagem_discursiva').bootstrapToggle('off')
            $('#container_montagem_manual_disc').show()
            $('#cabecalho_03_disc').text('3º')
            $('.btn_hide_on_ready_disc').hide()
            $('#container_requisicao_montagem_manual_disc').show()
            $('#container_requisicao_montagem_automatica_disc').hide()
            $('#select_qst_discursivas').text("Listar Questões")
            $('#btn_get_questoes_discursivas').val('Listar')
        }
        // --------------------------------------------
    });

    // ---- Funcoes assicronas add / remove / excluir --------------------------------------------
    $(document).ready(function() {

        // ---- Questoes Objetivas ---------------------------------------------------------------
        $('.add_qst_obj_async').click(function(){
            var isAdd = confirm('Você tem certeza que deseja adicionar essa questão ao simulado?')

            const id = this.id.split('_').pop()

            const btn_add_qst = $('#btn_add_qst_obj_'+id)
            const btn_remove_qst = $('#btn_remove_qst_obj_'+id)
            
            const btn_add_qst_modal = $('#btn_add_qst_obj_modal_'+id)
            const btn_remove_qst_modal = $('#btn_remove_qst_obj_modal_'+id)

            var tr = $('#questao_objetiva_'+id)
            var modal = $('#modal_'+id)

            var tabela_simulado = $('#tbody_simulado_obj')
            var tabela_externa = $('#tbody_externa_obj')
            var data_table_empty = $('.dataTables_empty')

            if(isAdd) {

                $.ajax({
                    url: '/addQuestaoSimulado/Async/',
                    data: {
                        questao_id: id,
                        simulado_id: $('#simulado_id').val()
                    },
                    success: function(result) {
                        $('#tipo_montagem_objetiva').prop('checked', false)

                        if(result){
                            tr = tr.detach()
                            modal.modal('hide')

                            tr.removeClass('questoes_externas_obj')
                            tr.addClass('questoes_simulado_obj')

                            btn_add_qst.hide()
                            btn_remove_qst.show()

                            btn_add_qst_modal.hide()
                            btn_remove_qst_modal.show()

                            btn_remove_qst.removeClass('btn_hide_on_ready')
                            btn_remove_qst_modal.removeClass('btn_hide_on_ready')

                            data_table_empty.detach()
                            tabela_simulado.append(tr)

                            alert('Questão adicionada com sucesso!')
                        }

                        if($('.questoes_externas_obj').length == 0) {
                            $('#tabela_externa').hide()
                            $('#questoes_obj_externas_empty').show()
                        }

                        if($('.questoes_simulado_obj').length > 0) {
                            $('#tabela_simulado').show()
                            $('#questoes_obj_simulado_empty').hide()
                        }
                    }
                });
            }
        });
        
        $('.remove_qst_obj_async').click(function() {
            var isRemove = confirm('Você tem certeza que deseja remover essa questão do simulado?')
            
            const id = this.id.split('_').pop()

            const btn_add_qst = $('#btn_add_qst_obj_'+id)
            const btn_remove_qst = $('#btn_remove_qst_obj_'+id)

            const btn_add_qst_modal = $('#btn_add_qst_obj_modal_'+id)
            const btn_remove_qst_modal = $('#btn_remove_qst_obj_modal_'+id)

            var modal = $('#modal_'+id)
            var tr = $('#questao_objetiva_'+id)

            var tabela_externa = $('#tbody_externa_obj')
            var tabela_simulado = $('#tbody_simulado_obj')
            var data_table_empty = $('.dataTables_empty')

            
            // $('.questoes_simulado_obj').length
            // alert($('.questoes_externas_obj'))

            if(isRemove) {
                $.ajax({
                    url: '/removeQuestaoSimulado/Async/',
                    data: {
                        questao_id: id,
                        simulado_id: $('#simulado_id').val(),
                    },
                    success: function(result) {
                        $('#tipo_montagem_objetiva').prop('checked', false)

                        if(result) {

                            tr = tr.detach()
                            modal.modal('hide')

                            tr.addClass('questoes_externas_obj')
                            tr.removeClass('questoes_simulado_obj')

                            btn_add_qst.show()
                            btn_remove_qst.hide()

                            btn_add_qst_modal.show()
                            btn_remove_qst_modal.hide()

                            btn_add_qst.removeClass('btn_hide_on_ready')
                            btn_add_qst_modal.removeClass('btn_hide_on_ready')

                            btn_remove_qst.addClass('btn_hide_on_ready')
                            btn_remove_qst_modal.addClass('btn_hide_on_ready')

                            data_table_empty.detach()
                            tabela_externa.append(tr)
                            
                            alert('Questão removida com sucesso!')
                        }

                        if($('.questoes_simulado_obj').length == 0) {
                            $('#tabela_simulado').hide()
                            $('#questoes_obj_simulado_empty').show()
                        }

                        if($('.questoes_externas_obj').length > 0) {
                            $('#tabela_externa').show()
                            $('#questoes_obj_externas_empty').hide()
                        }
                    }
                });
            }
        });

        $('.excluir_qst_obj_async').click(function() {
            
            var isDel = confirm('Você tem certeza que deseja remover?')

            const id = this.id.split('_').pop()

            var modal = $('#modal_'+id)
            var tr = $('#questao_objetiva_'+id)

            if(isDel) {

                $.ajax({
                    url: '/removeQuestaoSimulado/Async/',
                    data: {
                        questao_id: id,
                        simulado_id: $('#simulado_id').val(),
                    },
                    success: function(result) {
                        $('#tipo_montagem_objetiva').prop('checked', true)

                        if(result) {

                            tr.detach()
                            modal.modal('hide')

                            tr.removeClass('questoes_simulado_obj')

                            alert('Questão removida com sucesso!')
                        }

                        if($('.questoes_simulado_obj').length == 0) {
                            $('#tabela_simulado').hide()
                            $('#questoes_obj_simulado_empty').show()
                        }

                        if($('.questoes_externas_obj').length > 0) {
                            $('#tabela_externa').show()
                            $('#questoes_obj_externas_empty').hide()
                        }
                    }
                });
            }
        });
        
        // ---------------------------------------------------------------------------------------

        // ---- Questoes Dicursivas --------------------------------------------------------------

        $('.add_qst_disc_async').click(function(){
            var isAdd = confirm('Você tem certeza que deseja adicionar essa questão ao simulado?')

            const id = this.id.split('_').pop()

            const btn_add_qst = $('#btn_add_qst_disc_'+id)
            const btn_remove_qst = $('#btn_remove_qst_disc_'+id)
            
            const btn_add_qst_modal = $('#btn_add_qst_disc_modal_'+id)
            const btn_remove_qst_modal = $('#btn_remove_qst_disc_modal_'+id)

            var tr = $('#questao_discursiva_'+id)
            var modal = $('#modal_disc_'+id)

            var tabela_simulado = $('#tbody_simulado_disc')
            var tabela_externa = $('#tbody_externa_disc')
            var data_table_empty = $('.dataTables_empty')

            if(isAdd) {

                $.ajax({
                    url: '/addQuestaoDiscursivaSimulado/Async/',
                    data: {
                        questao_id: id,
                        simulado_id: $('#simulado_id').val()
                    },
                    success: function(result) {
                        $('#tipo_montagem_discursiva').prop('checked', false)

                        if(result){
                            tr = tr.detach()
                            modal.modal('hide')

                            tr.removeClass('questoes_externas_disc')
                            tr.addClass('questoes_simulado_disc')

                            btn_add_qst.hide()
                            btn_remove_qst.show()

                            btn_add_qst_modal.hide()
                            btn_remove_qst_modal.show()

                            btn_remove_qst.removeClass('btn_hide_on_ready_disc')
                            btn_remove_qst_modal.removeClass('btn_hide_on_ready_disc')

                            data_table_empty.detach()
                            tabela_simulado.append(tr)

                            alert('Questão adicionada com sucesso!')
                        }

                        if($('.questoes_externas_disc').length == 0) {
                            $('#tabela_externa_disc').hide()
                            $('#questoes_disc_externas_empty').show()
                        }

                        if($('.questoes_simulado_disc').length > 0) {
                            $('#tabela_simulado_disc').show()
                            $('#questoes_disc_simulado_empty').hide()
                        }
                    }
                });
            }
        });

        $('.remove_qst_disc_async').click(function() {
            var isRemove = confirm('Você tem certeza que deseja remover essa questão do simulado?')

            const id = this.id.split('_').pop()

            const btn_add_qst = $('#btn_add_qst_disc_'+id)
            const btn_remove_qst = $('#btn_remove_qst_disc_'+id)

            const btn_add_qst_modal = $('#btn_add_qst_disc_modal_'+id)
            const btn_remove_qst_modal = $('#btn_remove_qst_disc_modal_'+id)

            var modal = $('#modal_disc_'+id)
            var tr = $('#questao_discursiva_'+id)

            var tabela_externa = $('#tbody_externa_disc')
            var tabela_simulado = $('#tbody_simulado_disc')
            var data_table_empty = $('.dataTables_empty')

            if(isRemove) {
                $.ajax({
                    url: '/removeQuestaoDiscursivaSimulado/Async/',
                    data: {
                        questao_id: id,
                        simulado_id: $('#simulado_id').val(),
                    },
                    success: function(result) {
                        $('#tipo_montagem_discursiva').prop('checked', false)

                        if(result) {

                            tr = tr.detach()
                            modal.modal('hide')

                            tr.addClass('questoes_externas_disc')
                            tr.removeClass('questoes_simulado_disc')

                            btn_add_qst.show()
                            btn_remove_qst.hide()

                            btn_add_qst_modal.show()
                            btn_remove_qst_modal.hide()

                            btn_add_qst.removeClass('btn_hide_on_ready_disc')
                            btn_add_qst_modal.removeClass('btn_hide_on_ready_disc')

                            btn_remove_qst.addClass('btn_hide_on_ready_disc')
                            btn_remove_qst_modal.addClass('btn_hide_on_ready_disc')

                            data_table_empty.detach()
                            tabela_externa.append(tr)
                            
                            alert('Questão removida com sucesso!')
                        }

                        if($('.questoes_simulado_disc').length == 0) {
                            $('#tabela_simulado_disc').hide()
                            $('#questoes_disc_simulado_empty').show()
                        }

                        if($('.questoes_externas_disc').length > 0) {
                            $('#tabela_externa_disc').show()
                            $('#questoes_disc_externas_empty').hide()
                        }
                    }
                });
            }
        });

        $('.excluir_qst_disc_async').click(function() {
            
            var isDel = confirm('Você tem certeza que deseja remover?')

            const id = this.id.split('_').pop()

            var modal = $('#modal_disc_'+id)
            var tr = $('#questao_discursiva_'+id)

            if(isDel) {

                $.ajax({
                    url: '/removeQuestaoDiscursivaSimulado/Async/',
                    data: {
                        questao_id: id,
                        simulado_id: $('#simulado_id').val(),
                    },
                    success: function(result) {
                        $('#tipo_montagem_discursiva').prop('checked', true)

                        if(result) {
                            
                            tr.detach()
                            modal.modal('hide')

                            tr.removeClass('questoes_simulado_disc')

                            alert('Questão removida com sucesso!')
                        }

                        if($('.questoes_simulado_disc').length == 0) {
                            $('#tabela_simulado_disc').hide()
                            $('#questoes_disc_simulado_empty').show()
                        }

                        if($('.questoes_externas_disc').length > 0) {
                            $('#tabela_externa_disc').show()
                            $('#questoes_disc_externas_empty').hide()
                        }
                    }
                });
            }
        });

        // ---------------------------------------------------------------------------------------

    });

</script>
