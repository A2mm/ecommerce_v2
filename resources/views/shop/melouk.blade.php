@extends('shop.master') 
@section('body')
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css'>
<style>
    .ta-editor {
        min-height: 300px;
        height: auto;
        overflow: auto;
        font-family: inherit;
        font-size: 100%;
    }

</style>
<div class="content_box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="register">
                   <form>
                    <div ng-app="textAngularTest" ng-controller="wysiwygeditor" class="container app">
                        <div text-angular="text-angular" name="htmlcontent" ng-model="htmlcontent" ta-disabled='disabled'></div>
                    </div>
                    <!---->
                    <div class="register-top-grid">
                        <span>Please enter your email address<label>*</label></span>
                        <input type="text" name="email">
                        <div class="register-but">
                            <input type="submit" value="Send">
                        </div>
                    </div>
                    <!---->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.4/angular.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.2.4/angular-sanitize.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/textAngular/1.1.2/textAngular.min.js'></script>
<script>
    angular.module("textAngularTest", ['textAngular']);

    function wysiwygeditor($scope) {
        $scope.htmlcontent = $scope.orightml;
        $scope.disabled = false;
    };

</script>

@stop
