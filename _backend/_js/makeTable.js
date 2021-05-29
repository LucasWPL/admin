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

    make(){
        var html = '<td><input type="checkbox"  id="bulkDelete"  /></td>';
        $(this.colunas).each(function(k,v){
            if(v[2] == 'input') {
                html += '<td><input type="'+v[3]+'" class="form-control employee-search-gridPrincipal-input" id="'+v[1]+'"></td>';
            }else if(v[2] == 'select'){
                var aux = v[3].split('; ');
                html += '<td><select id="'+v[1]+'" class="form-control employee-search-gridPrincipal-input">';
                $(aux).each(function(){
                    html += '<option value="'+this+'">'+this+'</option>';
                });
                html += '</select>';
            }
        });
        $('#camposPesquisa').html(html);
    }
}