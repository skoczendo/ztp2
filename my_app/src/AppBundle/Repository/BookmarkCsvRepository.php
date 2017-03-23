<?php
/**
 * Bookmark csv repository.
 */
namespace AppBundle\Repository;

/**
 * Class BookmarkCsvRepository.
 *
 * @package AppBundle\Repository
 */
class BookmarkCsvRepository implements BookmarkRepositoryInterface
{


    /**
     * Find all bookmarks.
     *
     * @return array Result
     */
    public function findAll()
    {
        $csvData = file_get_contents("/home/evika/ztp2/my_app/src/AppBundle/Repository/bookmarkDatabase.csv");
        $lines = explode(PHP_EOL, $csvData);
        $bookmarks = array();
        foreach ($lines as $line) {
            $bookmarks[] = str_getcsv($line);
        }
        var_dump($bookmarks);
        return $bookmarks;
    }

    /**
     * Find single record by its id.
     *
     * @param integer $id Single record index
     *
     * @return array Result
     */
    public function findOneById($id)
    {
        $csvData = file_get_contents("/home/evika/ztp2/my_app/src/AppBundle/Repository/bookmarkDatabase.csv");
        $lines = explode(PHP_EOL, $csvData);
        $bookmarks = array();
        foreach ($lines as $line) {
            $bookmarks[] = str_getcsv($line);
        }
        print_r($bookmarks);
        return isset($bookmarks[$id]) && count($bookmarks)
            ? $bookmarks[$id] : null;

    }
}

