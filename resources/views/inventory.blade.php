@extends('layouts/master')

@section('content')
  <div class="page-header">
    <h1>Inventory</h1>
  </div>

  <div class="panel panel-default">
    <form method="POST">
      {{ csrf_field() }}
      <div class="panel-heading">Item List</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-4">
            <select id="store" name="store" data-bind="options: stores, optionsText: 'name', optionsValue: 'id', optionsCaption: 'Select Store', value: selectedStore" class="form-control"></select>
          </div>
          <div class="col-sm-8">
            <div class="btn-group pull-right">
              <button type="button" id="addProduct" data-bind="click: addProduct" class="btn btn-primary">Add Product</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <td>Name</td>
            <td colspan="2">Price</td>
          </tr>
        </thead>
        <tbody id="fruitsList" data-bind="foreach: storeProducts">
          <tr>
            <td>
              <select class="form-control" name="products[]" data-bind="options: productList, optionsText: 'name', optionsValue: 'id', value: selectedProduct"></select>
            </td>
            <td>
              <input class="form-control" type="text" name="prices[]" data-bind="value: price">
            </td>
            <td>
              <a href="#" data-bind="click: $parent.removeProduct">Remove</a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
@stop

@section('scripts')
  <script src="/bower/knockout/dist/knockout.js"></script>
  <script>
    $(document).ready(function () {
      var productModel = function (productList, product) {
        var self = this;

        self.selectedProduct = ko.observable(product ? product.id : '');
        self.price = ko.observable(product ? product.pivot.price : '');
        self.productList = productList;
      }

      var viewModel = function () {
        var self = this;

        self.stores = ko.observableArray([]);
        self.products = ko.observableArray([]);
        self.selectedStore = ko.observable({});
        self.storeProducts = ko.observableArray([]);

        self.selectedStore.subscribe(function (newValue) {
          if (!newValue) {
            self.storeProducts([]);
            return;
          }

          $.get('/api/store/' + newValue + '/details', function (response) {
            loadProducts(response.fruits);
          });
        });

        self.addProduct = function () {
          self.storeProducts.push(new productModel(self.products));
        }

        self.removeProduct = function (product) {
          self.storeProducts.remove(product);
        }
      }

      var vm = new viewModel();

      function loadProducts(products) {
        vm.storeProducts([]);

        if (products.length == 0) return;

        products.forEach(function (product) {
          vm.storeProducts.push(new productModel(vm.products, product));
        });
      }

      $.get('/api/store', function (stores) {
        vm.stores(stores);
      });

      $.get('/api/fruit', function (products) {
        vm.products(products);
      });

      ko.applyBindings(vm);
    });
  </script>
@stop