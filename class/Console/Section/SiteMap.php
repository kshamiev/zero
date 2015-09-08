<?php
/**
 * Формирование карты сайта в формате xml.
 *
 * @package Console.Zero.Section
 * @author Konstantin Shamiev aka ilosa <konstantin@shamiev.ru>
 * @date 2015.01.01
 */
class Zero_Console_Section_SiteMap extends Zero_Controller
{
    /**
     * Формирование карты сайта в формате xml.
     */
    public function Action_Default()
    {
        $str = '<' . '?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // разделы
        $Section = Zero_Model::Makes('Zero_Section');
        $Section->AR->Sql_Where('IsAuthorized', '=', 'no');
        $Section->AR->Sql_Where('IsIndex', '=', 'yes');
        $Section->AR->Sql_Where('IsEnable', '=', 'yes');
        $section_list = $Section->AR->Select_Tree('ID, Name, Url');
        foreach ($section_list as $row)
        {
            $str .= '
            <url>
                <loc>' . HTTP . substr($row['Url'], strpos($row['Url'], '/')) . '</loc>
                <lastmod>' . date('Y-m-d') . '</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.5</priority>
            </url>';
        }

        // товары
        foreach (Zero_DB::Select_Array("SELECT ID, `Name` FROM Shop_Wares") as $row)
        {
            $str .= '
            <url>
                <loc>' . HTTP . '/product-id:' . $row['ID'] . '-' . Zero_Helper_Strings::Transliteration_Url($row['Name']) . '.html</loc>
                <lastmod>' . date('Y-m-d') . '</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.8</priority>
            </url>';
        }

        $str .= "\n</urlset>";
        Zero_Helper_File::File_Save(ZERO_PATH_SITE . '/sitemap.xml', $str);
        return $this->View->Fetch($this->ViewTplOutString);
    }
}