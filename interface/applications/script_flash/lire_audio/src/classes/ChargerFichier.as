package classes
{
	// nous importons les classes necessaires :
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.net.URLLoader;
	import flash.net.URLLoaderDataFormat;
	import flash.net.URLRequest;
	
	import mx.controls.TextArea;
	import mx.core.Application;


	
	public class ChargerFichier extends Sprite
	{
		public function ChargerFichier()
		{
			//CONTRUCTEUR
		}
		public var url:String = "garbage.xml";
        
        public function charger():void
        {
            var request:URLRequest = new URLRequest(url);
            var variables:URLLoader = new URLLoader();
            variables.dataFormat = URLLoaderDataFormat.TEXT;
            variables.addEventListener(Event.COMPLETE, completeHandler);
            variables.addEventListener(IOErrorEvent.IO_ERROR, onIOError); 
            try
            {
                variables.load(request);
            } 
            catch (error:Error)
            {
                trace("Erreur dans le chargement des données: " + error);
            }
        }
	    private function completeHandler(event:Event):void
	    {
	    	var listMessages:XML = new XML( event.target.data );
			var message:XMLList = listMessages.elements();
			var maFenetre :TextArea = new TextArea();
			maFenetre = Application.application.fenetre;
			maFenetre.setStyle("fontSize","11");
			maFenetre.setStyle("fontFamily","Verdana"); 
			maFenetre.setStyle("color","0x0C272F");
			var monArray :Array = new Array();
			
			for each(var unMessage:XML in message)
			{
				monArray.push(unMessage.heure + " [" + unMessage.pseudo + "] : " +unMessage.commentaire);
			}
			maFenetre.text = monArray.join("\n");
	     }
	
	     private function onIOError(event:IOErrorEvent):void 
		 {  
			trace("Error loading URL.");  
		 }
	}
}