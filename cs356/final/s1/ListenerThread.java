import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;

public class ListenerThread implements Runnable  {
		   private Thread t;
		   private String serverName;
		   private ServerSocket listener;
		   private Socket socket;
		   private Boolean running;
		   PrintWriter output;
		   
		   public ListenerThread(String name,int port) throws IOException {
			   serverName = name;
			   listener = new ServerSocket(port);
			   running = true;
		   }

		public void run() {
			while(running){
				try {
					socket = listener.accept();
	                try {
	                    PrintWriter output = new PrintWriter(socket.getOutputStream(), true);
	                    output.println(main.getRouter().returnTable());      	    	  	
	                } finally {
	                    socket.close();
	                }
		        } catch (IOException e) {
					e.printStackTrace();
				}						
			}
			
		   }
		   
		   public void Start() {
		      if (t == null) {
		         t = new Thread (this, serverName);
		         t.start ();
		      }
		   }
		   
		   public void Stop() {
			      if (t != null) {
			    	  running = false;
			         try {
						t.join();
						System.out.println("Thread Dead Redemption");
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
			      }
			   }

}
