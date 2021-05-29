class makeTable {
    constructor(colunas) {
        var array = [];
        $(colunas).each(function(k,v){
            array.push([k, v, 'input', 'text']);
        });
        this.colunas = array;
    }

    get getColunas() {
        return this.colunas;
    }
    
    setSelect(coluna, options){
        var found = this.colunas.find(element => element[1]  === coluna);
        this.colunas[found[0]] = [found[0], found[1], 'select', options];
    }

    setDate(ids){
        $(ids).each(function(){
            $('#'+this).daterangepicker().val('');
            $('#'+this).attr('autocomplete', 'off');
        });
    }
    
    setAttr(){
        $('.employee-search-gridPrincipal-input').css('min-width', '100px');
        $('#id').attr('style', '');
        $('#id').css('min-width', '50px');
    }

    getHtml(){
        var html = '<td><input type="checkbox"  id="bulkDelete"  /></td>';
        $(this.colunas).each(function(k,v){
            if(v[2] == 'input') {
                html += '<td><input type="'+v[3]+'" class="form-control employee-search-gridPrincipal-input" id="'+v[1]+'"></td>';
            }else if(v[2] == 'select'){
                var aux = v[3].split('; ');
                html += '<td><select id="'+v[1]+'" class="form-control employee-search-gridPrincipal-input">';
                html += '<option></option>';
                $(aux).each(function(){
                    html += '<option value="'+this+'">'+this+'</option>';
                });
                html += '</select>';
            }
        });
        return html;
    }

    setCamposPesquisas(){
        $('#camposPesquisa').html(this.getHtml());
        this.setAttr();
    }

    make(){        
        this.setCamposPesquisas();
    }
}