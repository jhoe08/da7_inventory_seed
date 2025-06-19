-- STEP 1
-- da7_distribution foreign keys
ALTER TABLE da7_distribution DROP FOREIGN KEY da7_distribution_ibfk_1; -- product_id
ALTER TABLE da7_distribution DROP FOREIGN KEY da7_distribution_ibfk_2; -- province_id
ALTER TABLE da7_distribution DROP FOREIGN KEY da7_distribution_ibfk_3; -- lgu_id
ALTER TABLE da7_distribution DROP FOREIGN KEY da7_distribution_ibfk_4; -- assoc_id

-- da7_lgu foreign key
ALTER TABLE da7_lgu DROP FOREIGN KEY da7_lgu_ibfk_1; -- province_id

-- da7_association foreign keys
ALTER TABLE da7_association DROP FOREIGN KEY da7_association_ibfk_1; -- province_id
ALTER TABLE da7_association DROP FOREIGN KEY da7_association_ibfk_2; -- lgu_id

-- da7_varieties and da7_commodities
ALTER TABLE da7_varieties DROP FOREIGN KEY da7_varieties_ibfk_1;
ALTER TABLE da7_commodities DROP FOREIGN KEY da7_commodities_ibfk_1;

-- da7_categories parent_id
ALTER TABLE da7_categories DROP FOREIGN KEY da7_categories_ibfk_1;

-- STEP 2
TRUNCATE TABLE da7_distribution;
TRUNCATE TABLE da7_germination_tests;
TRUNCATE TABLE da7_product;
TRUNCATE TABLE da7_association;
TRUNCATE TABLE da7_lgu;
TRUNCATE TABLE da7_province;
TRUNCATE TABLE da7_varieties;
TRUNCATE TABLE da7_commodities;
TRUNCATE TABLE da7_categories;

-- STEP 3
-- da7_distribution
ALTER TABLE da7_distribution
  ADD CONSTRAINT da7_distribution_ibfk_1 FOREIGN KEY (product_id) REFERENCES da7_product(product_id) ON DELETE CASCADE,
  ADD CONSTRAINT da7_distribution_ibfk_2 FOREIGN KEY (province_id) REFERENCES da7_province(province_id) ON DELETE CASCADE,
  ADD CONSTRAINT da7_distribution_ibfk_3 FOREIGN KEY (lgu_id) REFERENCES da7_lgu(lgu_id) ON DELETE CASCADE,
  ADD CONSTRAINT da7_distribution_ibfk_4 FOREIGN KEY (assoc_id) REFERENCES da7_association(assoc_id) ON DELETE CASCADE;

-- da7_lgu
ALTER TABLE da7_lgu
  ADD CONSTRAINT da7_lgu_ibfk_1 FOREIGN KEY (province_id) REFERENCES da7_province(province_id) ON DELETE CASCADE;

-- da7_association
ALTER TABLE da7_association
  ADD CONSTRAINT da7_association_ibfk_1 FOREIGN KEY (province_id) REFERENCES da7_province(province_id) ON DELETE CASCADE,
  ADD CONSTRAINT da7_association_ibfk_2 FOREIGN KEY (lgu_id) REFERENCES da7_lgu(lgu_id) ON DELETE CASCADE;

-- da7_varieties and da7_commodities
ALTER TABLE da7_varieties
  ADD CONSTRAINT da7_varieties_ibfk_1 FOREIGN KEY (category_id) REFERENCES da7_categories(category_id) ON DELETE CASCADE;

ALTER TABLE da7_commodities
  ADD CONSTRAINT da7_commodities_ibfk_1 FOREIGN KEY (category_id) REFERENCES da7_categories(category_id) ON DELETE CASCADE;

-- da7_categories (self-referencing)
ALTER TABLE da7_categories
  ADD CONSTRAINT da7_categories_ibfk_1 FOREIGN KEY (parent_id) REFERENCES da7_categories(category_id) ON DELETE SET NULL;