package
{
	import flash.events.*;
	import flash.media.Camera;
	import flash.net.*;
	import mx.controls.Alert;
	import flash.media.Microphone;
	
	public class ActionBouton
	{
		private var cam : Camera = Camera.getCamera();
		private var nc : NetConnection;
		private var ns : NetStream;
		private var mic:Microphone;
		public var pseudo_expediteur :String;
		public var rep :String;
		
		[Bindable]
		public var canPublish : Boolean = false; //Connecté à FMS ou non ?
		
		public function ActionBouton()
		{
			//CONSTRUCTEUR...
		}
		
		public function lancer() : void
		{
			// Pour indiquer au serveur qui doit être le client (peut être tout objet ActionScript)
			this.nc = new NetConnection();
			this.nc.client = this;
			// Red5 ne supporte que AMF0
			this.nc.objectEncoding = ObjectEncoding.AMF0;
			// Connection au serveur Red5 sur le port RTMP 1935
			this.nc.connect("rtmp://91.121.138.88/oflaDemo/echangemaisonbiz/"+this.rep);
			// On écoute les évènements de la couche transport
			this.nc.addEventListener(NetStatusEvent.NET_STATUS, netStatusHandler);
			this.nc.addEventListener(AsyncErrorEvent.ASYNC_ERROR, asyncErrorHandler);
			/*NetConnection.defaultObjectEncoding = ObjectEncoding.AMF0;
			nc = new NetConnection ();
			nc.addEventListener(NetStatusEvent.NET_STATUS, netStatusHandler);				
			nc.connect("rtmp://91.121.116.188/oflaDemo/"+this.rep);*/
		}
		
		private function netStatusHandler (event : NetStatusEvent) : void
		{
			switch (event.info.code)
			{
				case "NetConnection.Connect.Success": // Connection avec le serveur réussi
				{
					canPublish = true; // Nous sommes connecté à FMS
					break;	
				} 
				default:
					Alert.show("Attention...Assurez-vous que votre webcam soit branchée !");
					break;
			}
		}
 
 
		public function enregistrer () : void
		{
			Camera.getCamera();
			this.ns = new NetStream (this.nc);
			this.ns.attachCamera(cam);
			this.mic = Microphone.getMicrophone();
			this.ns.attachAudio(this.mic);
			try{
				this.ns.client = this;
				this.ns.publish(this.pseudo_expediteur,"record");
				Alert.show("Enregistrement en cours...");
			}
			catch (e:Error)
			{
				trace (e.message);
			}
		}
		
		public function stopCamera () : void
		{
			this.ns.close();
			Alert.show("Enregistrement terminé...");
		}
		
		public function pauseHandler():void
		{
			this.ns.pause();
		}
		public function playHandler():void
		{
			this.ns.resume();
		}
		public function stopHandler():void
		{
		// Pause the stream and move the playhead back to
		// the beginning of the stream.
			this.ns.pause();
			this.ns.seek(0);
		}
		public function togglePauseHandler(event:MouseEvent):void
		{
			this.ns.togglePause();
		}
 
		public function onBWDone():void
		{
			// Appelé par RED5 au moment de la connexion
		}
			
		public function onMetaData (data : Object) : void
		{
			// Appelé par RED5 au moment de la connexion
		}
	 
		public function onPlayStatus (data : Object) : void
		{
			// Appelé par RED5 au moment de la connexion
		}
		public function asyncErrorHandler(event:AsyncErrorEvent):void {
			// Appelé par RED5 au moment de la connexion
		}
	}
}