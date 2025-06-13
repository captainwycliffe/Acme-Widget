# Acme Widget Co - Shopping Basket System

A PHP implementation of a shopping basket system with delivery charges and promotional offers, built as a technical assessment demonstrating modern PHP development practices.

## 🚀 Features

- **Product Catalog Management**: Three widget products with different pricing
- **Smart Shopping Basket**: Add products, calculate totals with automatic quantity handling
- **Tiered Delivery Charges**: 
  - Free delivery for orders over $90
  - Reduced delivery ($2.95) for orders over $50
  - Standard delivery ($4.95) for smaller orders
- **Promotional Offers**: "Buy one, get one half price" for Red Widgets
- **Comprehensive Testing**: Unit and integration tests with 100% scenario coverage
- **Static Analysis**: PHPStan level 8 compliance
- **Docker Support**: Containerized development environment

## 📋 Requirements

- PHP 8.4+ (or use Docker)
- Composer
- Docker & Docker Compose (optional)

## 🏗️ Installation

### Option 1: Docker (Recommended)

```bash
# Clone/download the project
git clone <your-repo-url>
cd acme-widget-basket

# Build and start containers
docker-compose up -d

# Install dependencies
docker-compose exec php composer install

# Run tests
docker-compose exec php vendor/bin/phpunit

# Run static analysis
docker-compose exec php vendor/bin/phpstan analyse

# See it in action
docker-compose exec php php example.php
```

### Option 2: Local Development

```bash
# Install dependencies
composer install

# Run all tests
vendor/bin/phpunit

# Run static analysis
vendor/bin/phpstan analyse

# See example output
php example.php
```

## 🧪 Testing

The project includes comprehensive test coverage:

### Run All Tests
```bash
# With Docker
make docker-all-tests

# Locally
make all-tests
```

### Test Suites
- **Unit Tests**: Test individual components in isolation
- **Integration Tests**: End-to-end basket scenarios
- **Static Analysis**: PHPStan level 8 for type safety

### Expected Test Results
All integration tests verify the exact scenarios from requirements:

| Basket Contents | Expected Total |
|----------------|----------------|
| B01, G01 | $37.85 |
| R01, R01 | $54.37 (with BOGO offer) |
| R01, G01 | $60.85 |
| B01, B01, R01, R01, R01 | $98.27 (free delivery + offer) |

## 💻 Usage

### Basic Example

```php
<?php
require 'vendor/autoload.php';

use Acme\Widget\Factory\BasketFactory;

// Create a new basket
$basket = BasketFactory::create();

// Add products
$basket->add('R01'); // Red Widget
$basket->add('G01'); // Green Widget
$basket->add('B01'); // Blue Widget

// Get total (includes delivery and offers)
echo "Total: $" . number_format($basket->total(), 2);

// Get item details
foreach ($basket->getItems() as $item) {
    echo $item->product->name . " x" . $item->quantity . "\n";
}
```

### Product Catalog

| Code | Product | Price |
|------|---------|-------|
| R01 | Red Widget | $32.95 |
| G01 | Green Widget | $24.95 |
| B01 | Blue Widget | $7.95 |

### Delivery Rules

- **Free Delivery**: Orders $90 and above
- **Reduced Delivery**: Orders $50-$89.99 → $2.95
- **Standard Delivery**: Orders under $50 → $4.95

### Current Offers

- **Red Widget Special**: Buy one Red Widget, get the second at half price

## 🏛️ Architecture

The system follows SOLID principles and modern PHP practices:

### Design Patterns Used
- **Strategy Pattern**: Delivery calculation and promotional offers
- **Repository Pattern**: Product data access abstraction
- **Factory Pattern**: Centralized object creation and dependency wiring
- **Dependency Injection**: Constructor-based injection throughout

### Project Structure
```
src/
├── Factory/           # Object factories for dependency wiring
│   └── BasketFactory.php
├── Model/            # Domain models (immutable data structures)
│   ├── Product.php
│   └── BasketItem.php
├── Repository/       # Data access layer
│   ├── ProductRepositoryInterface.php
│   └── InMemoryProductRepository.php
└── Service/          # Business logic
    ├── Basket.php
    ├── DeliveryCalculatorInterface.php
    ├── TieredDeliveryCalculator.php
    ├── OfferInterface.php
    ├── BuyOneGetOneHalfPriceOffer.php
    └── OfferService.php

tests/
├── Integration/      # End-to-end scenario tests
│   └── BasketIntegrationTest.php
└── Unit/            # Component-level tests
    ├── Model/
    └── Service/
```

## 🎯 Key Design Decisions

### 1. **Money as Integers**
- Stored all prices in cents to avoid floating-point precision issues
- Only convert to dollars for display purposes

### 2. **Immutable Products** 
- Products are `readonly` to prevent accidental modification
- Data integrity guaranteed at compile time

### 3. **Strategy Pattern for Business Rules**
- Easy to add new delivery rules or promotional offers
- Business logic isolated and testable

### 4. **Explicit Interfaces**
- Small, focused contracts for better testability
- Easy mocking and extension

### 5. **Type Safety**
- Strict types throughout (`declare(strict_types=1)`)
- PHPStan level 8 compliance
- Comprehensive PHPDoc annotations

## 🛠️ Development Tools

### Make Commands
```bash
make install          # Install dependencies
make test            # Run PHPUnit tests
make phpstan         # Run static analysis
make docker-build    # Build Docker containers
make docker-up       # Start containers
make docker-down     # Stop containers
make all-tests       # Run tests + static analysis
```

### Quality Assurance
- **PHPUnit 10**: Modern testing framework
- **PHPStan Level 8**: Maximum static analysis
- **PSR-4 Autoloading**: Standard PHP autoloading
- **Strict Types**: Type safety enforcement

## 🚀 Extending the System

### Adding New Products
```php
// In InMemoryProductRepository::__construct()
$this->products['Y01'] = new Product('Y01', 'Yellow Widget', 1995);
```

### Adding New Offers
```php
// Create new offer class implementing OfferInterface
class BuyTwoGetOneFreeOffer implements OfferInterface 
{
    // Implementation here
}

// Register in BasketFactory
$offers = [
    new BuyOneGetOneHalfPriceOffer('R01'),
    new BuyTwoGetOneFreeOffer('G01'),
];
```

### Custom Delivery Rules
```php
// Create new calculator implementing DeliveryCalculatorInterface
class CustomDeliveryCalculator implements DeliveryCalculatorInterface 
{
    // Implementation here
}
```

## 📊 Performance Considerations

- **O(n) basket operations**: Linear time complexity for most operations
- **Memory efficient**: Minimal object creation, reuse where possible
- **Lazy calculation**: Totals calculated on-demand
- **Immutable data**: Prevents accidental state mutations

## 🔍 Testing Strategy

### Unit Tests
- Test individual components in isolation
- Mock dependencies for focused testing
- Cover edge cases and boundary conditions

### Integration Tests
- Test complete user scenarios
- Verify actual business requirements
- End-to-end validation of the system

### Static Analysis
- Catch type errors at development time
- Ensure code quality standards
- Prevent common PHP pitfalls

## 📝 Requirements Fulfilled

✅ **Composer**: Dependency management and autoloading  
✅ **PHPUnit**: Comprehensive unit and integration tests  
✅ **PHPStan**: Level 8 static analysis  
✅ **Docker**: Complete containerization setup  
✅ **Docker Compose**: Multi-service orchestration  
✅ **Dependency Injection**: Constructor injection throughout  
✅ **Strategy Pattern**: For delivery and offers  
✅ **Sensible Types**: Strong typing with strict mode  
✅ **Good Separation**: Clean architecture with clear boundaries  
✅ **Small Interfaces**: Focused, single-responsibility contracts  

## 🤝 Contributing

This project was built as a technical assessment demonstrating:
- Clean, maintainable code architecture
- Modern PHP development practices
- Comprehensive testing strategies
- Professional development workflow

## 📄 License

This project is for assessment purposes.

---

**Built with ❤️ using modern PHP practices**
