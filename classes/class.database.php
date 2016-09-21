<?php

/* 
 * 
 * 
 * 
 */

class FonDatabase
{
    public function __construct()
    {
        if (PDODAO::connect() == true)
        {

        }
        else
        {
                die("NO DATABASE CONNECTION");
        }
    }

    public function testquery()
    {
        $sql = "SELECT
            s.name AS plaats,
            g.name AS gemeente
            FROM
            mhl_cities s,
            mhl_communes g
            WHERE
            s.commune_ID=g.id
            ORDER BY
            g.name,
            s.name";
        $result = PDODAO::getDataArrays($sql);
        return $result;
                
    }
    
    public function queryOpdracht1()
    {
        $sql = "SELECT
            s.name AS plaats,
            g.name AS gemeeente,
            p.name AS provincie
            FROM
            mhl_cities s,
            mhl_communes g,
            mhl_districts p
            WHERE
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            p.country_ID=151
            ORDER BY
            p.name,
            g.name,
            s.name";
        $result = PDODAO::getDataArrays($sql);
        return $result;
    }
    
    public function queryOpdracht2()
    {
        $sql = "SELECT
            p.name AS provincie,
            g.name AS gemeeente,
            COUNT(s.id) AS total
            FROM
            mhl_cities s,
            mhl_communes g,
            mhl_districts p
            WHERE
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            p.country_ID=151
            GROUP BY
            p.name,
            g.name
            ORDER BY
            p.name,
            g.name";
                
        $result = PDODAO::getDataArrays($sql);
        return $result;     
    }
    
    public function queryOpdracht3()
    {
        $sql = "SELECT
            p.name AS provincie,
            g.name AS gemeeente,
            COUNT(s.id) AS total
            FROM
            mhl_cities s,
            mhl_communes g,
            mhl_districts p
            WHERE
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            p.country_ID=151
            GROUP BY
            p.name,
            g.name
            HAVING COUNT(total) > 10
            ORDER BY
            total DESC,
            p.name,
            g.name";
                
        $result = PDODAO::getDataArrays($sql);
        return $result;     
    }
    
    public function queryOpdracht4()
    {
        $sql ="SELECT
            l.name AS leverancier,
            l.postcode AS postcode,
            s.name AS plaats
            FROM
            mhl_suppliers l,
            mhl_cities s,
            mhl_districts p,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id
            GROUP BY
            s.name,
            l.postcode
            ORDER BY
            p.name,
            g.name,
            s.name";
        
        
        
        $result = PDODAO::getDataArrays($sql);
        return $result; 
    }
    
    public function queryOpdracht5()
    {
        $sql ="SELECT
            l.name AS leverancier,
            s.name AS plaats,
            c.lat AS latitude
            FROM
            mhl_suppliers l,
            mhl_cities s,
            pc_lat_long c,
            mhl_communes g,
            mhl_districts p
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            c.pc6=l.postcode
            GROUP BY
            l.name,
            s.name
            ORDER BY
            c.lat DESC
            LIMIT 5";
        
        $result = PDODAO::getDataArrays($sql);
        return $result; 
    }
    
    public function queryOpdracht6()
    {
        $sql ="(SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Drenthe'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Utrecht'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Gelderland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Flevoland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Friesland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Groningen'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Limburg'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Noord-Brabant'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Noord-Holland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Overijssel'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Zeeland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Zuid-Holland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            ORDER BY provincie, hits DESC";
        
        $result = PDODAO::getDataArrays($sql);
        return $result; 
    }
    
    public function testqueryding()
    {
        $sql = "(SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Drenthe'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Utrecht'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Gelderland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Flevoland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Friesland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Groningen'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Limburg'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Noord-Brabant'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Noord-Holland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Overijssel'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Zeeland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            UNION ALL
            (SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Zuid-Holland'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
            LIMIT 10)
            ORDER BY provincie, hits DESC
            ";
        
        $result = PDODAO::getDataArrays($sql);
        return $result; 
    }
}












/*

(SELECT
            p.name AS provincie,
            l.name AS leverancier,
            SUM(h.hitcount) AS hits
            FROM
            mhl_suppliers l,
            mhl_districts p,
            mhl_hitcount h,
            mhl_cities s,
            mhl_communes g
            WHERE
            l.city_ID = s.id AND
            p.country_ID=151 AND
            s.commune_ID=g.id AND
            g.district_ID=p.id AND
            h.supplier_ID=l.id AND
            p.name = 'Drenthe'
            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
            hits DESC
 * 
 *            GROUP BY
            p.name,
            l.name
            ORDER BY
            p.name,
 * 
 */