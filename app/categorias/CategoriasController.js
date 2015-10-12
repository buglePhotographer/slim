var categorias = angular.module("backendEcommerce.categorias");

categorias.controller("CategoriasController", function(CategoriaService){
	
	var self = this;
	this.categorias = [];
    this.editOn = false;
	
	this.formLabel = "Nueva Categoría";
	
	this.getCategorias = function(){
            CategoriaService.getCategorias().then(function(data){
            self.categorias = data;
        });
    };
    
    this.getCategorias();
    
    this.createCategoria = function(){
        CategoriaService.createCategoria(self.cat_desc).then(function(response){
            if(response.data.error){
                alert("Ocurrio un error");
                return;
            }
            alert("Categoria creada con el id: " + response.data.data.categoria_id);
            self.getCategorias();
            self.cat_desc = '';
        })
    };
    
    this.activeItem = function($index, item){
        self.selectedIndex = $index;
        self.categoriaSeleccionada = item;
    };

    this.updateCategoria = function(){
        CategoriaService.updateCategoria(self.cat_desc, self.categoriaSeleccionada.categoria_id).then(function(response){
            if(response.data.error){
                alert("Ocurrio un error");
                return;
            }
            alert("Categoria actualizada");
            self.getCategorias();
            self.cat_desc = '';
            self.editOn = false;
        })
    };
    
    this.putCategoria = function(){
        self.cat_desc = self.categoriaSeleccionada.categoria_desc;
        self.editOn = true;
    };
    
    this.cleanCat = function(){
        self.cat_desc = '';
        self.editOn = false;
    };
    
});