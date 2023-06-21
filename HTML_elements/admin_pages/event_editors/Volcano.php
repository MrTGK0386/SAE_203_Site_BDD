$sql = "CREATE TABLE sae203_volcano(
   `id`                       INT PRIMARY KEY AUTO_INCREMENT
  ,`volcano_name`             VARCHAR(34) NOT NULL
  ,`primary_volcano_type`     VARCHAR(19) NOT NULL
  ,`last_eruption_year`       VARCHAR(7) NOT NULL
  ,`country`                  VARCHAR(32) NOT NULL
  ,`region`                   VARCHAR(30) NOT NULL
  ,`subregion`                VARCHAR(38) NOT NULL
  ,`latitude`                 NUMERIC(7,3) NOT NULL
  ,`longitude`                NUMERIC(8,3) NOT NULL
  ,`elevation`                INTEGER  NOT NULL
  ,`tectonic_settings`        VARCHAR(47) NOT NULL
  ,`evidence_category`        VARCHAR(18) NOT NULL
  ,`major_rock_1`             VARCHAR(40) NOT NULL
  ,`major_rock_2`             VARCHAR(40)
  ,`major_rock_3`             VARCHAR(40)
  ,`major_rock_4`             VARCHAR(40)
  ,`major_rock_5`             VARCHAR(40)
  ,`minor_rock_1`             VARCHAR(40)
  ,`minor_rock_2`             VARCHAR(40)
  ,`minor_rock_3`             VARCHAR(40)
  ,`minor_rock_4`             VARCHAR(23)
  ,`minor_rock_5`             VARCHAR(1)
  ,`population_within_5_km`   INTEGER  NOT NULL
  ,`population_within_10_km`  INTEGER  NOT NULL
  ,`population_within_30_km`  INTEGER  NOT NULL
  ,`population_within_100_km` INTEGER  NOT NULL
)";