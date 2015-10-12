var backendEcommerce = angular.module("backendEcommerce");

backendEcommerce.service("CategoriaService", function($http){

	this.getCategorias = function(){
		var promise = $http.get('api/apiSlim.php/categorias');
		return promise.then(function(response){
			return response.data.data.categorias;
		})
	};
    
    this.createCategoria = function(cat_desc){
        data = 
        {
            'categoria_desc' : cat_desc    
        };
        
        var promise = $http.post('api/apiSlim.php/createCategoria', data);
        return promise.then(function(response){
            return response;
        });
    };
    
    this.updateCategoria = function(cat_desc, id){
        data = 
        {
            'categoria_id' : id,
            'categoria_desc' : cat_desc    
        };
        
        var promise = $http.post('api/categorias.php?action=update', data);
        return promise.then(function(response){
            return response;
        });
    };
    
    
    
    
    
    
    
    
    
    
	
});