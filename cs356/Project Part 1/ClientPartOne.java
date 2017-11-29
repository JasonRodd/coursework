import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.ConnectException;
import java.net.Socket;
import java.net.UnknownHostException;
import java.util.Scanner;

public class ClientPartOne {
	
	private static String ServerIP;
	private static boolean connected = false;
	private static Socket socket;
	
    public static void main(String[] args) throws IOException {
    	setServerIPManually();
    	
    	try{
    		socket = new Socket(ServerIP, 55556);
    		connected = true;
    	} catch (ConnectException e){
    		System.err.println("Error Connecting");
    		connected = false;
    	} catch (UnknownHostException e){
    		System.err.println("unknown host");
    		connected = false;
    	}
    	
    	if(connected){
	    	BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()));
	        String answer = input.readLine();
	        System.out.println(answer);
    	}

    }
    
    

	public String getServerIP() {
		return ServerIP;
	}

	public static void setServerIP(String serverIP) {
		ServerIP = serverIP;
	}
	
	public static void setServerIPManually(){
        System.out.print("Enter IP Address:");
        Scanner input = new Scanner(System.in);
        String address = input.nextLine();
        ServerIP = address;
	}
    
}