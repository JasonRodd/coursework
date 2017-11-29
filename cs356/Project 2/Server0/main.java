import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.ConnectException;
import java.net.ServerSocket;
import java.net.Socket;
import java.net.UnknownHostException;
import java.util.Scanner;

public class main {
	private static ListenerThread serverListener;
	private static Routing router;
	private static Socket socket;
	
	private static String server1 = "128.235.208.225";
	private static int server1Port = 50241;
	
	public static void main(String[] args) throws IOException {
			serverListener = new ListenerThread("Server0", 55240);
			serverListener.Start();
			
			router = new Routing();
			System.out.println("Initial Table");
			System.out.println(router.returnTable());
			
			System.out.println("\n");
			
			while(true){
				Scanner input = new Scanner(System.in);
				String address = input.nextLine();
				if(address.equals("exit")){
					break;
				} else if(address.equals("grab")){
			    	socket = new Socket(server1, server1Port);
			    	BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
			    	String answer = "";
			    	String table = "";
			    	while((answer = in.readLine()) != null){
				        table += answer + ":";
			        }
			    	router.updateTable(table, "SERVER1");
				} else {
					System.out.println("no command");
				}	
			}

			System.out.println("Final Table");
			System.out.println(router.returnTable());
	    	
			
	}

	public static Routing getRouter() {
		return router;
	}

	public static void setRouter(Routing router) {
		main.router = router;
	}

	
}
