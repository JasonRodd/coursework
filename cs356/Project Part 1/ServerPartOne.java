import java.io.IOException;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;

public class ServerPartOne {
	
	
    public static void main(String[] args) throws IOException {
        ServerSocket listener = new ServerSocket(55556);
  
        try {
            while (true) {
                Socket socket = listener.accept();
                try {
                    PrintWriter output = new PrintWriter(socket.getOutputStream(), true);
                    output.println("Connection has been made on port " + socket.getPort());
                    System.out.println("Connected to " + socket.getInetAddress().getHostName() + " on port " + socket.getPort());
                } finally {
                    socket.close();
                }
                break;
            }
        }
        finally {
            listener.close();
        }
    }
}