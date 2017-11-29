import java.util.HashMap;
import java.util.Map;

public class Routing {
	private Map<String, Integer> route;
	
	public Routing(){
		route = new HashMap<String, Integer>();
		Initalize();
	}
	
	private void Initalize(){
		route.put("SERVER0", 1);
		route.put("SERVER1", 0);
		route.put("SERVER2", 1);
		route.put("SERVER3", 999999);
	}
	
	public String returnTable(){
		String table = "";
		for(String key: route.keySet()){
			table += (key + "," + route.get(key) + "\n");
		}
		return table;
	}
	
	public void updateTable(String routes, String fromserver){
		String server = "";
		HashMap<String, Integer> otherTable = new HashMap<String, Integer>();
		int dist = 999999;
		int last = 0;
		for(int i = 0; i < routes.length()-1; i++){
			if(routes.charAt(i) == ','){
				server = routes.substring(last, i);
				last = i;
			}
			if(routes.charAt(i) == ':'){
				dist = Integer.parseInt(routes.substring(last+1, i));
				last = i+1;
				otherTable.put(server, dist);
			}
			
		}
		
		for(String key1: route.keySet()){
			int currentDist = route.get(key1);
			if(!key1.equals(fromserver)){
				if( route.get(fromserver) + otherTable.get(key1) < currentDist){
					int newCost = route.get(fromserver) + otherTable.get(key1);
					route.put(key1, newCost);
				}
			}

		
		}
		
		System.out.println("\n");
		
	}

}

