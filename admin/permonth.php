<?php
					$select="
					SELECT a.checkout_date, SUM(a.checkout_quantity) as total_qty,
					SUM(a.checkout_quantity*b.price) as total_price
					,SUM(a.checkout_addons) as addons
					FROM checkout as a
					LEFT JOIN tbl_product as b
					ON a.checkout_product_id = b.id
					WHERE a.checkout_status='3'
					GROUP BY MONTH(checkout_date)";

					$result = $con->query($select);

					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) { ?> 
					
				<tr>
					<?php
					$date = strtotime($row["checkout_date"]);
					
					?>
					<td><?php echo date('F Y', $date); ?></td>
					<!-- <td><?php echo $row["total_qty"]; ?></td> -->
					<td>P <?php echo $row["total_price"]+$row['addons']; ?>.00</td>
					
					
				</tr>			
				<?php	
					}
					} else {
					echo "<tr><td colspan='10'>0 results</td></tr>";
					}
				?>
				
				</tbody>
			</table>
		</div>
	</div>


		<br><br>
	</body>
</html>
