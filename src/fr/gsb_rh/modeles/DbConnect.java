package fr.gsb_rh.modeles;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
/**
 * Classe de connexion à la base de données de GSB.
 * @author antoine & audrey
 * @version 1.0
 * @see RequeteBase
 * */
public class DbConnect{
	private static Connection connexion;
	private String url ="jdbc:mysql://localhost/gsb_appli_frais";
	private String login = "GSB";
	private String password = "GSB";
	/**
	 * Constructeur privé de l'objet DBConnect.
	 * privé car on utilise un singleton pour y accéder. 
	 **/ 
	private DbConnect(){
		try{
			Class.forName("com.mysql.jdbc.Driver");
			connexion = DriverManager.getConnection(this.url,this.login, this.password);
		}
		catch(SQLException e){
			e.printStackTrace();
		}
		catch(ClassNotFoundException e){
			e.printStackTrace();
		}
	}
	/**
	 * Méthode d'accès au singleton
	 * */
	public static Connection getDbConnect(){
		if(connexion == null)
			new DbConnect();
		return connexion;
	}
	/**
	 * Méthode de destruction de la connexion à la base 
	 * */
	public static void destroyDbConnect(){
		try {
			connexion.close();
		}
		catch(SQLException e){
			// TODO Auto-generated catch block
			e.printStackTrace();
		}finally{
			connexion = null;
		}
	}
}