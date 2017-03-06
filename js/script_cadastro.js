var appcadastro= angular.module('appcadastro',[]);

appcadastro.controller('userCtrl', function($scope){

	$scope.checkSenha = function(userInfo) {
    	 if (userInfo.ConfirmaSenha!=userInfo.Senha) {
        	$scope.userForm.ConfirmaSenha.$setValidity("valid", false);
        }else{
        	$scope.userForm.ConfirmaSenha.$setValidity("valid", true);
        }
    
  	};

  	$scope.checkEmail = function(userInfo) {
    	 if (userInfo.ConfirmaEmail!=userInfo.Email) {
        	$scope.userForm.ConfirmaEmail.$setValidity("valid", false);
        }else{
        	$scope.userForm.ConfirmaEmail.$setValidity("valid", true);
        }
    
  	};


	$scope.Valida_Data= function(userInfo){
		//meses com 31dias
		if (userInfo.Mes==1||userInfo.Mes==3||userInfo.Mes==5||userInfo.Mes==7||userInfo.Mes==8||userInfo.Mes==10||userInfo.Mes==12) {
				if (userInfo.Dia>31) {
				$scope.userForm.Dia.$setValidity("valid", false);
				}else{
					$scope.userForm.Dia.$setValidity("valid", true);
				}
				
		}
		//meses com 30dias
		if (userInfo.Mes==4||userInfo.Mes==6||userInfo.Mes==9||userInfo.Mes==11) {
			
				if (userInfo.Dia>30) {
				$scope.userForm.Dia.$setValidity("valid", false);
				}else{
					$scope.userForm.Dia.$setValidity("valid", true);
				}
		}
		//mes de fevereiro
		if (userInfo.Mes==2) {
			//verifica se o ano é bisexto
			if (userInfo.Ano % 400 == 0) {
					if (userInfo.Dia>29) {
					$scope.userForm.Dia.$setValidity("valid", false);
					}else{
					$scope.userForm.Dia.$setValidity("valid", true);	
					}
			}
			else{
				if (userInfo.Ano % 4 ==0 && userInfo.Ano%100 !=0) {
					if (userInfo.Dia>29) {
					$scope.userForm.Dia.$setValidity("valid", false);
					}else{
					$scope.userForm.Dia.$setValidity("valid", true);
					}
				}
				else{
					if (userInfo.Dia>28) {
						$scope.userForm.Dia.$setValidity("valid", false);
						}else{
						$scope.userForm.Dia.$setValidity("valid", true);
						}
			}
			}	
		}//fim da validacao do ano bissexto	
		//Valida Data Futura		
		var now= new Date
		var dia= now.getDay()+3		
		var mes= now.getMonth()+1
		var ano= now.getFullYear()

		
		if (userInfo.Ano>ano) {
			$scope.userForm.Ano.$setValidity("valid", false);
			

		}
		if (userInfo.Ano<=ano) {
			$scope.userForm.Ano.$setValidity("valid", true);
		}

		if (userInfo.Mes<=mes) {
			$scope.userForm.Mes.$setValidity("valid", true);
		}

		if (userInfo.Dia<=dia) {
			$scope.userForm.Dia.$setValidity("valid", true);
		}
		if (userInfo.Mes>mes && userInfo.Ano >= ano) {
			$scope.userForm.Mes.$setValidity("valid", false);	
		}	
		if (userInfo.Dia>dia && userInfo.Mes>=mes && userInfo.Ano>=ano) {
				$scope.userForm.Dia.$setValidity("valid", false);
		}
	}
});

