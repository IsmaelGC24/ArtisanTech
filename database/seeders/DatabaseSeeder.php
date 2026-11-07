<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /*
    seed the application's database.
    */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@artisantech.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $categories = [];
        $categoryData = [
            'Laptops' => 'Portátiles para trabajo y estudio',
            'Celulares' => 'Teléfonos inteligentes',
            'Tablets' => 'Tabletas para trabajo y entretenimiento',
            'Consolas' => 'Consolas de videojuegos',
            'Smartwatches' => 'Relojes inteligentes',
            'Audio' => 'Audífonos y parlantes',
        ];
        foreach ($categoryData as $name => $description) {
            $categories[$name] = Category::create(['name' => $name, 'description' => $description]);
        }

        $brands = [];
        $brandData = [
            'Lenovo' => ['China', 'https://www.lenovo.com'],
            'Samsung' => ['Corea del Sur', 'https://www.samsung.com'],
            'Sony' => ['Japón', 'https://www.sony.com'],
            'Apple' => ['Estados Unidos', 'https://www.apple.com'],
            'Microsoft' => ['Estados Unidos', 'https://www.microsoft.com'],
            'Nintendo' => ['Japón', 'https://www.nintendo.com'],
            'ASUS' => ['Taiwán', 'https://www.asus.com'],
        ];
        foreach ($brandData as $name => [$country, $website]) {
            $brands[$name] = Brand::create(['name' => $name, 'country' => $country, 'website' => $website]);
        }

        // name, brand, category, price, stock, active
        $products = [
            ['ThinkPad X1', 'Lenovo', 'Laptops', 1800.00, 9, true],
            ['IdeaPad 5', 'Lenovo', 'Laptops', 750.00, 20, true],
            ['MacBook Air', 'Apple', 'Laptops', 1200.00, 14, true],
            ['MacBook Pro', 'Apple', 'Laptops', 2200.00, 6, true],
            ['Zenbook 14', 'ASUS', 'Laptops', 1100.00, 11, true],
            ['Vivobook 15', 'ASUS', 'Laptops', 650.00, 25, true],
            ['Surface Laptop 5', 'Microsoft', 'Laptops', 1300.00, 8, true],
            ['iPhone 15', 'Apple', 'Celulares', 950.00, 18, true],
            ['Galaxy S24', 'Samsung', 'Celulares', 900.00, 15, true],
            ['Galaxy A55', 'Samsung', 'Celulares', 420.00, 30, true],
            ['iPad Air', 'Apple', 'Tablets', 650.00, 12, true],
            ['iPad Pro', 'Apple', 'Tablets', 1100.00, 5, true],
            ['PlayStation 5', 'Sony', 'Consolas', 550.00, 10, true],
            ['PlayStation 4', 'Sony', 'Consolas', 300.00, 0, false],
            ['Xbox Series X', 'Microsoft', 'Consolas', 520.00, 7, true],
            ['WH-1000XM5', 'Sony', 'Audio', 350.00, 12, true],
            ['WF-C700N', 'Sony', 'Audio', 110.00, 0, true],
            ['iPhone 13', 'Apple', 'Celulares', 799.00, 12, true],
            ['iPhone 13 Pro', 'Apple', 'Celulares', 999.00, 8, true],
            ['iPhone 13 Pro Max', 'Apple', 'Celulares', 1099.00, 6, true],
            ['iPhone 14', 'Apple', 'Celulares', 799.00, 14, true],
            ['iPhone 14 Pro', 'Apple', 'Celulares', 999.00, 9, true],
            ['iPhone 14 Pro Max', 'Apple', 'Celulares', 1099.00, 7, true],
            ['iPhone 15', 'Apple', 'Celulares', 799.00, 18, true],
            ['iPhone 15 Pro', 'Apple', 'Celulares', 999.00, 12, true],
            ['iPhone 15 Pro Max', 'Apple', 'Celulares', 1199.00, 9, true],
            ['iPhone 16', 'Apple', 'Celulares', 799.00, 20, true],
            ['iPhone 16 Pro', 'Apple', 'Celulares', 999.00, 14, true],
            ['iPhone 16 Pro Max', 'Apple', 'Celulares', 1199.00, 10, true],
            ['iPhone 17', 'Apple', 'Celulares', 799.00, 22, true],
            ['iPhone 17 Pro', 'Apple', 'Celulares', 1099.00, 15, true],
            ['iPhone 17 Pro Max', 'Apple', 'Celulares', 1199.00, 11, true],
            ['iPhone 18 Pro', 'Apple', 'Celulares', 1199.00, 10, true],
            ['iPhone 18 Pro Max', 'Apple', 'Celulares', 1299.00, 8, true],
            ['Galaxy S25', 'Samsung', 'Celulares', 799.99, 15, true],
            ['Galaxy S25+', 'Samsung', 'Celulares', 999.99, 12, true],
            ['Galaxy S25 Ultra', 'Samsung', 'Celulares', 1299.99, 10, true],
            ['Galaxy S26', 'Samsung', 'Celulares', 999.99, 14, true],
            ['Galaxy S26+', 'Samsung', 'Celulares', 1199.99, 10, true],
            ['Galaxy S26 Ultra', 'Samsung', 'Celulares', 1399.99, 8, true],
            ['AirPods 3', 'Apple', 'Audio', 169.00, 20, true],
            ['AirPods 4', 'Apple', 'Audio', 129.00, 30, true],
            ['AirPods Pro 3', 'Apple', 'Audio', 249.00, 22, true],
            ['AirPods Max', 'Apple', 'Audio', 549.00, 6, true],
            ['PlayStation 1', 'Sony', 'Consolas', 120.00, 3, true],
            ['PlayStation 2', 'Sony', 'Consolas', 150.00, 4, true],
            ['PlayStation 3', 'Sony', 'Consolas', 200.00, 5, true],
            ['PlayStation 4', 'Sony', 'Consolas', 280.00, 8, true],
            ['PlayStation 5 Pro', 'Sony', 'Consolas', 749.99, 6, true],
            ['Xbox Series S', 'Microsoft', 'Consolas', 399.99, 12, true],
            ['Xbox Series X', 'Microsoft', 'Consolas', 649.99, 8, true],
            ['Nintendo Switch', 'Nintendo', 'Consolas', 299.99, 15, true],
            ['Apple Watch Series 9', 'Apple', 'Smartwatches', 399.00, 8, true],
            ['Apple Watch Series 10', 'Apple', 'Smartwatches', 399.00, 10, true],
            ['Apple Watch Series 11', 'Apple', 'Smartwatches', 399.00, 14, true],
            ['Apple Watch Ultra 2', 'Apple', 'Smartwatches', 799.00, 5, true],
            ['Apple Watch Ultra 3', 'Apple', 'Smartwatches', 799.00, 7, true],
        ];

        foreach ($products as [$name, $brand, $category, $price, $stock, $active]) {
            Product::create([
                'name' => $name,
                'description' => 'Producto de prueba: '.$name,
                'price' => $price,
                'stock' => $stock,
                'active' => $active,
                'brand_id' => $brands[$brand]->getId(),
                'category_id' => $categories[$category]->getId(),
            ]);
        }
        $this->call(DemoActivitySeeder::class);
    }
}
