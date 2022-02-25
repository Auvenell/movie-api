<?php
namespace DataLayer;

class MovieData
{
	private \PDO $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function getAllMovies(): array
	{
		$stmt = $this->db->prepare('select * from film');
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getMatchingMovies($searchTerm) {
		$stmt = $this->db->prepare('
			SELECT 
				title, description, rating
			FROM 
				film
			WHERE
				film.title
					LIKE "%'.$searchTerm.'%"
		');
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}
