<?php
include("../../config/config.php");
extract($_POST);
error_reporting(E_ALL & ~ E_NOTICE);

$busca_cap_emails = $_GET['busca_cap_emails'];
	
if ($busca_cap_emails == $busca_cap_emails) {  ?>
<section class="content"> 
                    <div class="row"> 
                        <div class="col-xs-12"> 
                            <div class="box"> 
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>E-Mail</th>
                                                <th>Data de Cadastro</th> 
                                            </tr>
                                        </thead>   
			<?php 
	$sql = $con->prepare("SELECT * FROM $tabela1 WHERE EMAIL LIKE ?"); 
	$sql->BindValue(1, $busca_cap_emails .'%');
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	$quantreg = count( $sql_verifc );
	
	if ($quantreg > 0) {
				foreach($sql_verifc as $ln_verifc) {
					$data = $ln_verifc->DATA;
					$data = implode("/",array_reverse(explode("-",$data)));
?>
				<tbody>
					<tr>
						<td class='class1'><?php echo $ln_verifc->ID; ?></td> 
						<td class='class2'> <?php echo $ln_verifc->EMAIL; ?></td>
					    <td class='class1'><?php echo $data; ?></td> 
					</tr>	
				</tbody>  	 
	<?php 		} 
	} else { echo "<b style='color:red;'>Nenhum Resultado encontrado !!! </b>"; } ?>  
<tfoot> 
                                            <tr>
                                                <th>Id</th>
                                                <th>E-Mail</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </tfoot> 
                                    </table>
<br> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div> 
                </section><!-- /.content --> 

 
<?php } ?> 