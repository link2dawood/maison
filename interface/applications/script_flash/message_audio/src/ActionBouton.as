package
{
	import flash.events.*;
	import flash.media.Microphone;
	import flash.net.*;
	
	import mx.controls.Alert;
	
	public class ActionBouton
	{
		private var nc : NetConnection;
		private var ns : NetStream;
		private var mic:Microphone;
		public var pseudo_expediteur :String;
		public var rep :String;
		
		[Bindable]
		public var canPublish : Boolean = false; //Connecté à RED5 ou non ?
		
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
		}
		
		private function netStatusHandler (event : NetStatusEvent) : void
		{
			switch (event.info.code)
			{
				case "NetConnection.Connect.Success": // Connection avec le serveur réussi
				{
					this.canPublish = true;// Connecté sur RED5
					break;	
				} 
				default:
					Alert.show("Attention...Assurez-vous que votre webcam soit branchée !");
					break;
			}
		}
 
 
		public function enregistrer () : void
		{
			this.ns = new NetStream (this.nc);
			this.mic = Microphone.getMicrophone();
			this.ns.attachAudio(this.mic);
			try{
				this.ns.client = this;
				this.ns.publish(this.pseudo_expediteur,"record");
				Alert.show("Record in progress...");
			}
			catch (e:Error)
			{
				trace (e.message);
			}
		}
		
		public function ecouter () : void
		{
			try{
				this.ns.client = this;
				this.ns.play(this.pseudo_expediteur);
				Alert.show("Play your message...");
			}
			catch (e:Error)
			{
				trace (e.message);
			}
		}
		
		public function stopCamera () : void
		{
			this.ns.close();
			Alert.show("Stop...");
		}
		
		public function pauseHandler():void
		{
			this.ns.pause();
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