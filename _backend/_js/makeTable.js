class makeTable {
    constructor(colunas, url, status = false) {
        var array = [];
        $(colunas).each(function(k,v){
            array.push([k, v, 'input', 'text']);
        });
        this._colunas = array;
        this._grid = url;
        this._status = status;
    }

    get colunas() {
        return this._colunas;
    }
    set colunas(value) {
        this._colunas = value;
    }

    get grid() {
        return this._grid;
    }
    
    set grid(value) {
        this._grid = value;
    }

    get sql() {
        return this._sql;
    }
    
    set sql(value) {
        this._sql = value.replaceAll("\t", ' ').replaceAll("\r\n", '');
    }

    get status() {
        return this._status;
    }

    set status(value) {
        this._status = value;
    }

    get dateIds(){
        return this._dateIds;
    }
    
    set dateIds(ids){
        this._dateIds = ids;
    }

    get moneyIds(){
        return this._moneyIds;
    }
    
    set moneyIds(ids){
        this._moneyIds = ids;
    }
    
    
    setSelect(coluna, options, condicoes = false){
        var found = this.colunas.find(element => element[1]  === coluna);
        if(found) this.colunas[found[0]] = [found[0], found[1], 'select', options, condicoes];
    }

    setDateColumn(){
        $(this.dateIds).each(function(){
            $('#'+this).daterangepicker({
                "locale": {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Janeiro",	
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
                }
            });
            $('#'+this).attr('autocomplete', 'off');
            
            $('#'+this).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')).change();
            });

            $('#'+this).on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('').change();
            });
        });
    }

    setDate(ids, format = 'range'){
        $(ids).each((index, value)=>{
            var found = this.colunas.find(element => element[1][0]  === value);
            if(found) this.colunas[found[0]] = [found[0], found[1], 'date', 'text', format];
        });
        this.dateIds = ids;               
    }

    setMoneyColumn(){
        $(this.moneyIds).each(function(){
            $('#'+this).maskMoney({
                thousands: '.', 
                decimal: ','
            });
        });
    }

    setMoney(ids, casas = 2){
        $(ids).each((index, value)=>{
            var found = this.colunas.find(element => element[1][0]  === value);
            if(found) this.colunas[found[0]] = [found[0], found[1], 'money', 'text', casas];
        });   
        this.moneyIds = ids;         
    }
    
    setAttr(){
        $('.employee-search-gridPrincipal-input').css('min-width', '100px');
        $('.employee-search-gridPrincipal-input').click(function(){
            return false;
        });
        $('#id').attr('style', '');
        $('#id').css('min-width', '50px');
    }

    getCamposPesquisa(){
        var html = '<td><input type="checkbox"  id="bulkDelete"  /></td>';
        $(this.colunas).each(function(key, value){
            if(value[2] == 'input' || value[2] == 'date' || value[2] == 'money') {
                html += '<td><input type="'+value[3]+'" class="form-control employee-search-gridPrincipal-input" id="'+value[1][0]+'"></td>';
            }else if(value[2] == 'select'){
                html += '<td><select id="'+value[1][0]+'" class="form-control employee-search-gridPrincipal-input">';
                html += '<option></option>';
                $(value[3]).each(function(){
                    html += '<option value="'+this+'">'+this.capitalize()+'</option>';
                });
                html += '</select>';
            }
        });
        return html;
    }

    getCamposTitulo(){
        var html = '<th class="thCkechboxGrid"></th>';
        $(this.colunas).each(function(key, value){
            html += '<th>'+value[1][1]+'</th>';
        });
        return html;
    }

    setCamposPesquisas(){
        $('#camposTitulo').html(this.getCamposTitulo());
        $('#camposPesquisa').html(this.getCamposPesquisa());
        this.setAttr();
    }

    loadTable(){
        let grid = this.grid;
        let status = this.status;
        var tabela = $('#gridPrincipal').DataTable({
            "ajax":
            {
                "url": '_backend/_controller/_select/_grid/'+this.grid+'',
                "data": {
                "colunas": this.colunas
            }},
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "processing": true,
            "language": {
                "processing": "Aguarde...",
                "infoFiltered": "(Filtrando _MAX_ registros)"
            },
            "serverSide": true,
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if(status != false ){
                    //MUDANDO AS CORES DAS COLUNAS DE ACORDO COM OS STATUS
                    if(grid == 'receita_select_grid.php'){
                        if(aData[status] == 'Apagada') $('td', nRow).css('background-color', '#f2f2f2');
                        if(aData[status] == 'Baixada') $('td', nRow).css('background-color', '#ccffdd');
                        if(aData[status] == 'Baixa parcial') $('td', nRow).css('background-color', '#e6ffee');
                        if(aData[status] == 'Vencida') $('td', nRow).css('background-color', '#ff9980');
                    }else if(grid == 'fluxo_caixa_select_grid.php'){
                        if(aData[status] == 'Receita') $('td', nRow).css('background-color', '#ccffdd');
                        if(aData[status] == 'Despesa') $('td', nRow).css('background-color', '#ffc2b3');
                    }			
                }
            },
            "fnDrawCallback": (data)=>{
                this.sql = data.json.sql;
            }
        });
        
        this.setDateColumn();
        this.setMoneyColumn();
        
        $('#gridPrincipal_filter').css('display', 'none');
        $('#gridPrincipal').css({
            "border-color": "#d1d1d1", 
            "border-width":"1px", 
            "border-style":"solid"
        });
        $('.employee-search-gridPrincipal-input').on('keyup change', function (event) {
            var i = $(this).attr('id'); // getting column index
            var v = $(this).val(); // getting search input value
            $(colunas).each((key, value)=>{
                if(value[0].indexOf(i) > -1) i = key;
            });
            tabela.columns(i).search(v).draw();
        });

        return tabela;
    }

    make(){        
        this.setCamposPesquisas();
        return this.loadTable();
    }

    relatorio(){
        $('#formulario-relatorio input[name=sql]').val(this.sql);
        $('#formulario-relatorio input[name=colunas]').val(JSON.stringify(this.colunas));
        $('#formulario-relatorio').submit();
    }
}