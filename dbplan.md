# Database Plan

# Tables

- book
    -> id
    -> weight
    -> product_id (FK -> id on product)

- dvd_disc
    -> id
    -> size
    -> product_id (FK -> id on product)

- furniture
    -> id
    -> height
    -> width
    -> length
    -> product_id (FK -> id on product)

- product
    -> id
    -> sku
    -> name
    -> price
    -> type