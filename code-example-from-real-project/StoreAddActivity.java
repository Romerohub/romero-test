package ru.netkurator.universalshoppinglist;
 
import ru.netkurator.universalshoppinglist.models.Stores;
import android.os.Bundle;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Intent;
import android.database.Cursor;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

public class StoreAddActivity extends Activity implements OnClickListener{

	private Button buttonSave;
	private Button buttonBack;
	private Stores stores;
	private EditText fieldName;
	private String store_id = null;
	
	private StoreAddActivity  saaContext;
	private AlertDialog alert;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_store_add);
		saaContext = this;
		
		store_id = null;
		stores = new Stores(this);
		
		buttonBack = (Button) findViewById(R.id.btnBack);
		buttonBack.setOnClickListener(this);
		
		buttonSave = (Button) findViewById(R.id.storeSave);
		buttonSave.setOnClickListener(this);
		
		String tmp = getIntent().getStringExtra("s_id");

		if(tmp != null){
			TextView s_id = (TextView)findViewById(R.id.store_id);
			s_id.setText(tmp);
			
			store_id = tmp;
			
			Cursor item = stores.getById(tmp);
			
			Integer index = item.getColumnIndex(Stores.COLUMN_NAME);
			
			if(item.moveToFirst()){
				String name = item.getString(index);
			
				TextView s_name = (TextView)findViewById(R.id.storeName);
				s_name.setText(name);
				
				Button deleteBtn = (Button) findViewById(R.id.deleteBtn);
				deleteBtn.setVisibility(View.VISIBLE );
				deleteBtn.setOnClickListener(this);
			
			}else{
				//Log.d("nnn", "no store data by id");
			}
		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		//getMenuInflater().inflate(R.menu.shop_add, menu);
		return true;
	}

	@Override
	public void onClick(View v) {
		switch (v.getId()) {
		case R.id.deleteBtn:
			LinearLayout view = (LinearLayout) ((Activity) this).getLayoutInflater()
	        .inflate(R.layout.showyesnowdialog, null);

			AlertDialog.Builder builder = new AlertDialog.Builder(this);
			builder.setTitle("Deleting")
			.setView(view)
			.setMessage("Are you sure you want to delete? " )
			.setCancelable(true);
			
			ImageView imageCancel = (ImageView) view.findViewById(R.id.imageCancel);
			imageCancel.setOnClickListener(new OnClickListener() {
			    @Override
			    public void onClick(View v) {
					alert.cancel();
			    }
			});
			
			
			ImageView imageYes = (ImageView) view.findViewById(R.id.imageYes);
			imageYes.setOnClickListener(new OnClickListener() {
			    @Override
			    public void onClick(View v) {
			    	//Log.d("ddddd", r_id);
			    	if(store_id != null){
			    		stores.deleteById(store_id);
			    	}
			    	saaContext.finish();
				alert.cancel();
			    }
			});
			
			alert = builder.create();
			alert.show();
			
			break;
	    case R.id.storeSave:
	    	fieldName   = (EditText)findViewById(R.id.storeName);
	    	String pName = fieldName.getText().toString();
	    	
	    	String pIcon = "";
	    	
	    	TextView s_id = (TextView)findViewById(R.id.store_id);
			String s_num = (String) s_id.getText();
			if(s_num.equals("0")){
				stores.addRec(pName, pIcon);
			}else{
				stores.updateFieldById(s_num, "name", pName);
			}
	    	
	    	Intent intent = new Intent();
	        intent.putExtra("back_activity", "StoreAdd");
	        setResult(RESULT_OK, intent);
	        
	        finish();
	    	break;
	    case R.id.btnBack:
	    	finish();
		break;
	    default:
	        break;
	    }
	}

}
