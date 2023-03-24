<?php
class SearchController extends Controller
{
	public function searchProduct($htmlKeywords)
	{
		// echo $htmlKeywords;
		// $htmlKeyword = 'IPHONE 12 PRO MAX';
		
		// $arrayKeywords = explode(" ", $htmlKeywords);
		
		// foreach($arrayKeywords AS $arrayKeyword){
		// 	echo $arrayKeyword;
		// }
		$sql1 = $sql2 = null;
		$sql1 = "
			SELECT * 
			FROM products 
			WHERE 
		";
		// foreach($arrayKeywords AS $eachKey)
		// {
			
		// 	}
		$sql2 .= "product_tags = '".$htmlKeywords."' OR ";
		$sql2 = rtrim($sql2, " OR");

		// echo $sql2;
		
		$sql_code = $sql1 . $sql2; 
		
		// echo $sql_code;
		$query = $this->connection->prepare($sql_code);

		
		
		$query->execute();
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($dataList AS $data){
			// echo $data['category_id'];
		}
		$totalRowSelected = $query->rowCount();
		
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}	
	
	public function searchProductLimit($htmlKeywords)
	{
		$arrayKeywords = explode(" ", $htmlKeywords);
		
		$sql1 = $sql2 = null;
		$sql1 = "
			SELECT * 
			FROM products 
			WHERE 
		";
		foreach($arrayKeywords AS $eachKey)
		{
			$sql2 .= "product_tags LIKE '%".$eachKey."%' OR ";
			}
		$sql2 = rtrim($sql2, " OR");
		// $sql3 = " LIMIT {$start}, {$end} ";
		
		
		$sql_code = $sql1 . $sql2; 
		
		$query = $this->connection->prepare($sql_code);
		
		$query->execute();
		
		$pageList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $pageList;
		else
			return 0;
	}
}

/*
public function searchProduct($htmlKeywords)
{
	$arrayKeywords = explode(" ", $htmlKeywords);
	
	$sql1 = $sql2 = null;
	$sql1 = "
		SELECT * 
		FROM products 
		WHERE 
	";
	foreach($arrayKeywords AS $eachKey)
	{
		$sql2 .= "product_tags LIKE '%".$eachKey."%' OR ";
		}
	$sql2 = rtrim($sql2, " OR");
	
	$sql_code = $sql1 . $sql2; 
	
	$query = $this->connection->prepare($sql_code);
	
	$query->execute();
	
	$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
	$totalRowSelected = $query->rowCount();
	
	if($totalRowSelected > 0)
		return $dataList;
	else
		return 0;
}	
*/

# PATTERN OF SEARCH QUERY
/*	
	SELECT * 
	FROM products 
	WHERE 
		tags LIKE '%key%' OR 
		tags LIKE '%key%' OR 
		tags LIKE '%key%' OR 
		tags LIKE '%key%' OR 
		tags LIKE '%key%' OR 
*/
?>